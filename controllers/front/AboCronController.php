<?php
/*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
class AboCronControllerCore extends FrontController
{

	public function __construct()
	{
		parent::__construct();
		$this->context = Context::getContext();
		$this->Action();
	}

	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_PS_THEME_DIR_.'abo.tpl');
	}

	public function Action(){

		global $cookie;

		echo "<pre>";
		$sql = sprintf("SELECT * FROM %sabo WHERE script_parsing_day = '%s 00:00:00'", _DB_PREFIX_, date('Y-m-d'));
		$results = Db::getInstance()->ExecuteS($sql);

		if(!empty($results)){

			foreach ($results as $result) {

				$product_type = explode(",", $result["product_type"]);
				
				$customer = new Customer($result["customer_id"]);
				$order = new Order();

				if (!Validate::isLoadedObject($customer))throw new PrestaShopException('Can\'t load Customer object');

				$sql_address = sprintf("SELECT id_address FROM %saddress WHERE id_customer = %s", _DB_PREFIX_, $customer->id);
				$row_address = Db::getInstance()->getRow($sql_address);
				$id_address = !empty($row_address["id_address"]) ? $row_address["id_address"] : 1;

				if($result["payment_mode"] == "vir") $order->payment = "Virement bancaire";
				if($result["payment_mode"] == "che") $order->payment = "Chèque ou Espèces";
				if($result["payment_mode"] == "cat") $order->payment = "Carte bancaire";


				$order->id_customer = $customer->id; // dynamics
				$order->id_carrier = defined('PS_CARRIER_DEFAULT') ? PS_CARRIER_DEFAULT : 1; // dynamics
				$order->id_lang = $cookie->id_lang;
				$order->id_address_delivery = $id_address; // dynamics
				$order->id_shop = $customer->id_shop;
				$order->id_shop_group = $customer->id_shop_group;
				$order->id_currency = $cookie->id_currency;
				$order->id_address_invoice = $id_address; // dynamics
				$order->total_paid = "0.00";
				$order->total_paid_real = "0.00";
				$order->total_products = "0";
				$order->total_products_wt = "0.00";
				$order->conversion_rate = "0.00";


				// Create new cart
				$cart = new Cart();
				$cart->id_shop_group = $order->id_shop_group;
				$cart->id_shop = $order->id_shop;
				$cart->id_customer = $order->id_customer;
				$cart->id_carrier = $order->id_carrier;
				$cart->id_address_delivery = $order->id_address_delivery;
				$cart->id_address_invoice = $order->id_address_invoice;
				$cart->id_currency = $order->id_currency;
				$cart->id_lang = $order->id_lang;
				$cart->secure_key = $order->secure_key;


				$cart->add();
				$order->id_cart = $cart->id_cart;
				$order->save();

				$sql_products = sprintf("SELECT id_product FROM %sproduct", _DB_PREFIX_);
				$results_products = Db::getInstance()->ExecuteS($sql_products);

				$order_detail_memory = array();
				$is_ok = true;
				$portion = $result["portion"];
				$proportional = true;
				
				foreach ($product_type as $type) {
					if($portion == 12){
						$portion_total[$type] = 12 / count($product_type);
					}
					
					if($portion == 18){
						if(count($product_type) <= 3){
							$portion_total[$type] = 18 / count($product_type);	
						}
					}else{
						$proportional = false;
						$portion_total[$type] = 4;	
					}
				}
				
				if(!$proportional){
					$portion_total_first = $portion_total;
				 	reset($portion_total_first);
					$first_key = key($portion_total_first);
					$portion_total[$first_key] += 2;
				}
				
				foreach ($results_products as $results_product) {
					
					// products
					$product = new Product((int) $results_product["id_product"]);

					$product_type_row = $product["attributes"]["type"];
					$product_portion_row = $product["attributes"]["portion"];
					
					if(in_array($product_type_row, $product_type)){

						if($portion_total[$product_type_row] > 0 && ((int)$portion_total[$product_type_row] - (int)$product_portion_row >= 0)){
							//orders details
							$order_detail = new OrderDetail();
							$order_detail->id_order = $order->id;
							$order_detail->id_warehouse = 0;
							$order_detail->id_shop = $customer->id_shop;
		
							$order_detail->product_name = !empty($product->name[0]) ? $product->name[0] : $product->name[1];		
							$order_detail->product_quantity = 1; // important
															
							$order_detail->product_price = $product->price;
							$order_detail_memory[] = $order_detail;		
			
							$portion_total[$product_type_row] -= $product_portion_row;
						}						

					}
				}


				foreach ($portion_total as $portion_current) {
					if($portion_current != 0){
						$is_ok = false;
					}
				}
				
				if($is_ok){
					foreach ($order_detail_memory as $order_detail_m) {
						$order_detail_m->save();
					}	
				}
			}
		}
	}

}