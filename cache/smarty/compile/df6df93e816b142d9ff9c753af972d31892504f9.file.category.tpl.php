<?php /* Smarty version Smarty-3.1.8, created on 2013-04-29 19:01:26
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/project/lcdb/themes/lcdb_theme/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2013396990517ea766ee3fe5-20644409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df6df93e816b142d9ff9c753af972d31892504f9' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/project/lcdb/themes/lcdb_theme/category.tpl',
      1 => 1365548765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2013396990517ea766ee3fe5-20644409',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_517ea76700b806_05298111',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517ea76700b806_05298111')) {function content_517ea76700b806_05298111($_smarty_tpl) {?><div id="columns" class="content clearfix">
	<div id="left_column">
		<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-leftcol.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
	<div id="center_column" class="page-list-product">
		<?php if (isset($_smarty_tpl->tpl_vars['category']->value)){?>
			<?php if ($_smarty_tpl->tpl_vars['category']->value->id&&$_smarty_tpl->tpl_vars['category']->value->active){?>
					<?php if ($_smarty_tpl->tpl_vars['category']->value->id_parent==8){?>
						<?php echo $_smarty_tpl->getSubTemplate ("./category-boeuf.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					<?php }else{ ?>
						<?php echo $_smarty_tpl->getSubTemplate ("./category-subcat.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					<?php }?>
			<?php }elseif($_smarty_tpl->tpl_vars['category']->value->id){?>
				<p class="warning"><?php echo smartyTranslate(array('s'=>'This category is currently unavailable.'),$_smarty_tpl);?>
</p>
			<?php }?>
		<?php }?>
	</div><!-- end #center_column -->
	<div id="right_column">
		<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-rightcol.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
</div>
<?php }} ?>