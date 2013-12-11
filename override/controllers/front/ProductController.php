<?php

class ProductController extends ProductControllerCore
{
	public function initContent()
	{
		parent::initContent();

		$now = date("Y-m-d h:i:s");

		if(!(($now >= $this->product->date_start)&&($now <= $this->product->date_end))){
			echo "product not available";
		}

		// get zipcodes list
		if ($this->context->customer->id){
			$customer_adresses = $this->context->customer->getAddresses($this->context->language->id);
			foreach ($customer_adresses as $key => $address) {
				if(isset($address["postcode"]) && ($address["postcode"] != "")){
					$zipcodes[] = $address["postcode"];
				}
			}
		}
		
		$leftcol = Category::getLeftColumn($this->context->language->id, $zipcodes);
		$rightcol = Category::getRightColumn($this->context->language->id);

		$categories = Product::getProductCategoriesFull($this->product->id);

		$this->context->smarty->assign('left_col', $leftcol);
		$this->context->smarty->assign('right_col', $rightcol);
		$this->context->smarty->assign('recipes', $this->product->getRecipes($this->context->language->id));
		$this->context->smarty->assign('product_categories', $categories);
		
	}
}

