<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

define('ANZO_PATH', dirname(__FILE__));
define('ANZO_INCLUDES', ANZO_PATH . '/_includes');

// Ze Autoloader Bitte!
require_once(ANZO_INCLUDES . '/anzo/autoloader.php');

// Load Libraries
require_once(ANZO_INCLUDES . '/libs/meta-box/meta-box.php');

// Load Classes
$anzo_core = new ANZO\Classes\Core();
$anzo_filter = new ANZO\Classes\Filter();

// Load Admin
if (in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) || is_admin()) {
	$anzo_admin = new ANZO\Classes\Admin();
}