<?php

class Product extends ProductCore
{
	public $tricks;
	public $breeder;
	public $abo;
	public $unusual_product;
	public $product_type_cook;
	public $product_type_bio;
	public $product_type_wtlamb;
	public $product_type_wtpork;
	public $serving;
	public $id_lcdb_import;
    public $limit_date;
	public $date_start;
	public $date_end;
	
	public static $definition = array(
		'table' => 'product',
		'primary' => 'id_product',
		'multilang' => true,
		'multilang_shop' => true,
		'fields' => array(
			/* Classic fields */
			'id_shop_default' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_manufacturer' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_supplier' => 				array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'reference' => 					array('type' => self::TYPE_STRING, 'validate' => 'isReference', 'size' => 32),
			'supplier_reference' => 		array('type' => self::TYPE_STRING, 'validate' => 'isReference', 'size' => 32),
			'location' => 					array('type' => self::TYPE_STRING, 'validate' => 'isReference', 'size' => 64),
			'width' => 						array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
			'height' => 					array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
			'depth' => 						array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
			'weight' => 					array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
			'quantity_discount' => 			array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'ean13' => 						array('type' => self::TYPE_STRING, 'validate' => 'isEan13', 'size' => 13),
			'upc' => 						array('type' => self::TYPE_STRING, 'validate' => 'isUpc', 'size' => 12),
			'cache_is_pack' => 				array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'cache_has_attachments' =>		array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'is_virtual' => 				array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'abo' =>						array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'unusual_product' =>			array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'product_type_cook' => 			array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'product_type_bio' => 			array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'product_type_wtlamb' => 		array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'product_type_wtpork' => 		array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'serving' => 					array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 50),
			'id_lcdb_import' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'limit_date' => 			    array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'date_start' => 				array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
			'date_end' => 					array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),

			/* Shop fields */
			'id_category_default' => 		array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedId'),
			'id_tax_rules_group' => 		array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedId'),
			'on_sale' => 					array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'online_only' => 				array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'ecotax' => 					array('type' => self::TYPE_FLOAT, 'shop' => true, 'validate' => 'isPrice'),
			'minimal_quantity' => 			array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedInt'),
			'price' => 						array('type' => self::TYPE_FLOAT, 'shop' => true, 'validate' => 'isPrice', 'required' => true),
			'wholesale_price' => 			array('type' => self::TYPE_FLOAT, 'shop' => true, 'validate' => 'isPrice'),
			'unity' => 						array('type' => self::TYPE_STRING, 'shop' => true, 'validate' => 'isString'),
			'unit_price_ratio' => 			array('type' => self::TYPE_FLOAT, 'shop' => true),
			'additional_shipping_cost' => 	array('type' => self::TYPE_FLOAT, 'shop' => true, 'validate' => 'isPrice'),
			'customizable' => 				array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedInt'),
			'text_fields' => 				array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedInt'),
			'uploadable_files' => 			array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedInt'),
			'active' => 					array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'redirect_type' => 				array('type' => self::TYPE_STRING, 'shop' => true, 'validate' => 'isString'),
			'id_product_redirected' => 		array('type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isUnsignedId'),
			'available_for_order' => 		array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'available_date' => 			array('type' => self::TYPE_DATE, 'shop' => true, 'validate' => 'isDateFormat'),
			'condition' => 					array('type' => self::TYPE_STRING, 'shop' => true, 'validate' => 'isGenericName', 'values' => array('new', 'used', 'refurbished'), 'default' => 'new'),
			'show_price' => 				array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'indexed' => 					array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'visibility' => 				array('type' => self::TYPE_STRING, 'shop' => true, 'validate' => 'isProductVisibility', 'values' => array('both', 'catalog', 'search', 'none'), 'default' => 'both'),
			'cache_default_attribute' => 	array('type' => self::TYPE_INT, 'shop' => true),
			'advanced_stock_management' => 	array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'date_add' => 					array('type' => self::TYPE_DATE, 'shop' => true, 'validate' => 'isDateFormat'),
			'date_upd' => 					array('type' => self::TYPE_DATE, 'shop' => true, 'validate' => 'isDateFormat'),

			/* Lang fields */
			'meta_description' => 			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
			'meta_keywords' => 				array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
			'meta_title' => 				array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 128),
			'link_rewrite' => 				array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isLinkRewrite', 'required' => true, 'size' => 128),
			'name' => 						array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 128),
			'description' => 				array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
			'description_short' => 			array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
			'tricks' => 					array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
			'breeder' => 					array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
			'available_now' => 				array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
			'available_later' => 			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'IsGenericName', 'size' => 255),
		),
		'associations' => array(
			'manufacturer' => 				array('type' => self::HAS_ONE),
			'supplier' => 					array('type' => self::HAS_ONE),
			'default_category' => 			array('type' => self::HAS_ONE, 'field' => 'id_category_default', 'object' => 'Category'),
			'tax_rules_group' => 			array('type' => self::HAS_ONE),
			'categories' =>					array('type' => self::HAS_MANY, 'field' => 'id_category', 'object' => 'Category', 'association' => 'category_product'),
			'stock_availables' =>			array('type' => self::HAS_MANY, 'field' => 'id_stock_available', 'object' => 'StockAvailable', 'association' => 'stock_availables'),
		),
	);
	
	/**
	 * Delete product recipes
	 *
	 * @return mixed Deletion result
	 */
	public function deleteRecipes()
	{
		return Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'product_recipe` WHERE `id_product` = '.(int)$this->id);
	}

	/**
	 * Get product recipes (only names)
	 *
	 * @param integer $id_lang Language id
	 * @param integer $id_product Product id
	 * @return array Product recipes
	 */
	public static function getRecipesLight($id_lang, $id_product, Context $context = null)
	{
		if (!$context)
			$context = Context::getContext();

		$sql = 'SELECT r.`id_recipe`, rl.`title`
				FROM `'._DB_PREFIX_.'product_recipe` pr
				LEFT JOIN `'._DB_PREFIX_.'recipe` r ON (r.`id_recipe`= pr.`id_recipe`)
				'.Shop::addSqlAssociation('recipe', 'r').'
				LEFT JOIN `'._DB_PREFIX_.'recipe_lang` rl ON (
					r.`id_recipe` = rl.`id_recipe`
					AND rl.`id_lang` = '.(int)$id_lang.'
				)
				WHERE pr.`id_product` = '.(int)$id_product;

		return Db::getInstance()->executeS($sql);
	}

	/**
	 * Get product recipes
	 *
	 * @param integer $id_lang Language id
	 * @return array Product recipes
	 */
	public function getRecipes($id_lang, $active = true, Context $context = null)
	{
		if (!$context)
			$context = Context::getContext();

		$sql = 'SELECT r.*, rl.*
				FROM `'._DB_PREFIX_.'product_recipe` pr
				LEFT JOIN `'._DB_PREFIX_.'recipe` r ON r.`id_recipe` = pr.`id_recipe`
				'.Shop::addSqlAssociation('recipe', 'r').'
				LEFT JOIN `'._DB_PREFIX_.'recipe_lang` rl ON (
					r.`id_recipe` = rl.`id_recipe`
					AND rl.`id_lang` = '.(int)$id_lang.'
				)
				WHERE pr.`id_product` = '.(int)$this->id;

		if (!$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql))
			return false;

		return $result;
	}

	public static function getRecipeById($recipe_id)
	{
		return Db::getInstance()->getRow('SELECT `id_recipe`, `title` FROM `'._DB_PREFIX_.'recipe_lang` WHERE `id_recipe` = '.(int)$recipe_id);
	}

	/**
	 * Link recipes with product
	 *
	 * @param array $recipes_id Recipes ids
	 */
	public function changeRecipes($recipes_id)
	{
		foreach ($recipes_id as $id_recipe)
			Db::getInstance()->insert('product_recipe', array(
				'id_product' => (int)$this->id,
				'id_recipe' => (int)$id_recipe
			));
	}

    public static function getAdvancedFeaturesStatic($id_product, $id_lang)
    {
        if (!Feature::isFeatureActive())
            return array();

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT p.`id_feature`, p.`id_product`, p.`id_feature_value`, fvl.`value`
			FROM `'._DB_PREFIX_.'feature_product` p
			LEFT JOIN `'._DB_PREFIX_.'feature_value_lang` fvl ON (p.id_feature_value = fvl.id_feature_value) AND fvl.`id_lang` = '.(int)$id_lang.'
			WHERE p.`id_product` = '.(int)$id_product
        );

        return $result;
    }

	public static function getProductCategoriesFull($id_product = '', $id_lang = null)
	{
		if (!$id_lang)
			$id_lang = Context::getContext()->language->id;

		$ret = array();
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT cp.`id_category`, cl.`name`, cl.`link_rewrite`, c.`level_depth` FROM `'._DB_PREFIX_.'category_product` cp
			LEFT JOIN `'._DB_PREFIX_.'category` c ON (c.id_category = cp.id_category)
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (cp.`id_category` = cl.`id_category`'.Shop::addSqlRestrictionOnLang('cl').')
			'.Shop::addSqlAssociation('category', 'c').'
			WHERE cp.`id_product` = '.(int)$id_product.'
				AND cl.`id_lang` = '.(int)$id_lang
		);

		foreach ($row as $val)
			$ret[$val['id_category']] = $val;

		return $ret;
	}

    /**
     * Get all available attribute groups for product
     *
     * @param integer $id_lang Language id
     * @return array Attribute groups
     */
    public function getProductAttributesGroups($id_product, $id_lang)
    {
        if (!Combination::isFeatureActive())
            return array();

        $sql = 'SELECT ag.`id_attribute_group`, ag.`is_color_group`, agl.`name` AS group_name, agl.`public_name` AS public_group_name,
					a.`id_attribute`, al.`name` AS attribute_name, a.`color` AS attribute_color, pa.`id_product_attribute`,
					IFNULL(stock.quantity, 0) as quantity, product_attribute_shop.`price`, product_attribute_shop.`ecotax`, pa.`weight`,
					product_attribute_shop.`default_on`, pa.`reference`, product_attribute_shop.`unit_price_impact`,
					pa.`minimal_quantity`, pa.`available_date`, ag.`group_type`
				FROM `'._DB_PREFIX_.'product_attribute` pa
				'.Shop::addSqlAssociation('product_attribute', 'pa').'
				'.Product::sqlStock('pa', 'pa').'
				LEFT JOIN `'._DB_PREFIX_.'product_attribute_combination` pac ON pac.`id_product_attribute` = pa.`id_product_attribute`
				LEFT JOIN `'._DB_PREFIX_.'attribute` a ON a.`id_attribute` = pac.`id_attribute`
				LEFT JOIN `'._DB_PREFIX_.'attribute_group` ag ON ag.`id_attribute_group` = a.`id_attribute_group`
				LEFT JOIN `'._DB_PREFIX_.'attribute_lang` al ON a.`id_attribute` = al.`id_attribute`
				LEFT JOIN `'._DB_PREFIX_.'attribute_group_lang` agl ON ag.`id_attribute_group` = agl.`id_attribute_group`
				'.Shop::addSqlAssociation('attribute', 'a').'
				WHERE pa.`id_product` = '.(int)$id_product.'
					AND al.`id_lang` = '.(int)$id_lang.'
					AND agl.`id_lang` = '.(int)$id_lang.'
				GROUP BY id_attribute_group, id_product_attribute
				ORDER BY ag.`position` ASC, a.`position` ASC';

        return Db::getInstance()->executeS($sql);
    }
}

