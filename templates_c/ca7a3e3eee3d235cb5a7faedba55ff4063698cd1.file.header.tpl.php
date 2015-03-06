<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-06 10:13:42
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178865183154f072e7ec04d4-16874932%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca7a3e3eee3d235cb5a7faedba55ff4063698cd1' => 
    array (
      0 => './templates/header.tpl',
      1 => 1425636431,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178865183154f072e7ec04d4-16874932',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54f072e7f17fa1_80291428',
  'variables' => 
  array (
    'title' => 0,
    'Name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f072e7f17fa1_80291428')) {function content_54f072e7f17fa1_80291428($_smarty_tpl) {?><html>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['Name']->value;?>
</title>
    <link rel="stylesheet" lang="text/css" href="styles.css"/>
    <?php echo '<script'; ?>
 src="js/myScript.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/cdn/zDialog.js"><?php echo '</script'; ?>
>
</head>
<body>
<?php }} ?>
