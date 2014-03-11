<?php namespace ANZO\Classes;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class Filter {

	public function __construct()
	{
		add_filter('excerpt_more', array( $this, 'excerpt_more'));
		add_filter('the_content_more_link', array( $this, 'the_content_more_link'));
	}

	public function excerpt_more($more)
	{
		return ' ...';
	}

}
