<?php /* Smarty version Smarty-3.1.8, created on 2013-04-29 22:12:25
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/project/lcdb/administration/themes/default/template/layout-ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4573655517ed429cdc6d2-67199560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bdbac8973894d30cce1e4010ece4820afae5465' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/project/lcdb/administration/themes/default/template/layout-ajax.tpl',
      1 => 1361836056,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4573655517ed429cdc6d2-67199560',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'json' => 0,
    'status' => 0,
    'confirmations' => 0,
    'informations' => 0,
    'errors' => 0,
    'warnings' => 0,
    'page' => 0,
    'conf' => 0,
    'error' => 0,
    'info' => 0,
    'confirm' => 0,
    'warning' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_517ed429e43be3_49325610',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517ed429e43be3_49325610')) {function content_517ed429e43be3_49325610($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['json']->value)){?>
{
	"status" : "<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
",
	"confirmations" : <?php echo $_smarty_tpl->tpl_vars['confirmations']->value;?>
,
	"informations" : <?php echo $_smarty_tpl->tpl_vars['informations']->value;?>
,
	"error" : <?php echo $_smarty_tpl->tpl_vars['errors']->value;?>
,
	"warnings" : <?php echo $_smarty_tpl->tpl_vars['warnings']->value;?>
,
	"content" : <?php echo $_smarty_tpl->tpl_vars['page']->value;?>

}
<?php }else{ ?>

	<?php if (isset($_smarty_tpl->tpl_vars['conf']->value)){?>
		<div class="conf">
			<?php echo $_smarty_tpl->tpl_vars['conf']->value;?>

		</div>
	<?php }?>

	<?php if (count($_smarty_tpl->tpl_vars['errors']->value)){?> 
		<div class="error">
			<span style="float:right"><a id="hideError" href=""><img alt="X" src="../img/admin/close.png" /></a></span>
			<?php if (count($_smarty_tpl->tpl_vars['errors']->value)==1){?>
				<?php echo $_smarty_tpl->tpl_vars['errors']->value[0];?>

			<?php }else{ ?>
				<?php echo smartyTranslate(array('s'=>'%d errors','sprintf'=>count($_smarty_tpl->tpl_vars['errors']->value)),$_smarty_tpl);?>

				<br/>
				<ol>
					<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
						<li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
					<?php } ?>
				</ol>
			<?php }?>
		</div>
	<?php }?>

	<?php if (isset($_smarty_tpl->tpl_vars['informations']->value)&&count($_smarty_tpl->tpl_vars['informations']->value)&&$_smarty_tpl->tpl_vars['informations']->value){?>
		<div class="hint clear" style="display:block;">
			<?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['informations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
?>
				<?php echo $_smarty_tpl->tpl_vars['info']->value;?>
<br />
			<?php } ?>
		</div><br />
	<?php }?>

	<?php if (isset($_smarty_tpl->tpl_vars['confirmations']->value)&&count($_smarty_tpl->tpl_vars['confirmations']->value)&&$_smarty_tpl->tpl_vars['confirmations']->value){?>
		<div class="conf" style="display:block;">
			<?php  $_smarty_tpl->tpl_vars['confirm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['confirm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['confirmations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['confirm']->key => $_smarty_tpl->tpl_vars['confirm']->value){
$_smarty_tpl->tpl_vars['confirm']->_loop = true;
?>
				<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
<br />
			<?php } ?>
		</div><br />
	<?php }?>

	<?php if (count($_smarty_tpl->tpl_vars['warnings']->value)){?>
		<div class="warn">
			<span style="float:right">
				<a id="hideWarn" href=""><img alt="X" src="../img/admin/close.png" /></a>
			</span>
			<?php if (count($_smarty_tpl->tpl_vars['warnings']->value)>1){?>
				<?php echo smartyTranslate(array('s'=>'There are %d warnings.','sprintf'=>count($_smarty_tpl->tpl_vars['warnings']->value)),$_smarty_tpl);?>

				<span style="margin-left:20px;" id="labelSeeMore">
					<a id="linkSeeMore" href="#" style="text-decoration:underline"><?php echo smartyTranslate(array('s'=>'Click here to see more'),$_smarty_tpl);?>
</a>
					<a id="linkHide" href="#" style="text-decoration:underline;display:none"><?php echo smartyTranslate(array('s'=>'Hide warning'),$_smarty_tpl);?>
</a>
				</span>
			<?php }else{ ?>
				<?php echo smartyTranslate(array('s'=>'There is %d warning.','sprintf'=>count($_smarty_tpl->tpl_vars['warnings']->value)),$_smarty_tpl);?>

			<?php }?>
			<ul style="display:<?php if (count($_smarty_tpl->tpl_vars['warnings']->value)>1){?>none<?php }else{ ?>block<?php }?>;" id="seeMore">
			<?php  $_smarty_tpl->tpl_vars['warning'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['warning']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warnings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['warning']->key => $_smarty_tpl->tpl_vars['warning']->value){
$_smarty_tpl->tpl_vars['warning']->_loop = true;
?>
				<li><?php echo $_smarty_tpl->tpl_vars['warning']->value;?>
</li>
			<?php } ?>
			</ul>
		</div>
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['page']->value;?>

<?php }?>
<?php }} ?>