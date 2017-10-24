<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes();?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes();?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes();?>>
<!--<![endif]-->
<head>
<?php
/**
 * This hook is important for WordPress plugins and other many things
 */
wp_head();
?>
</head>
<body <?php body_class();?>>

