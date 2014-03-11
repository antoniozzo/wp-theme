<?php namespace ANZO;

if (!defined('ABSPATH')) exit;

class Autoloader {

	static public function load($class)
	{
		$path = ANZO_INCLUDES . '/' . strtolower(implode('/', explode('\\', $class))) . '.php';

		if (is_readable($path)) {
			require_once($path);
		}
	}

}

spl_autoload_register(__NAMESPACE__ .'\Autoloader::load');
