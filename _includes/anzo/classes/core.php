<?php namespace ANZO\Classes;

if (!defined('ABSPATH')) exit;

class Core {

	public $uri;
	public $current_action;
	public $action_variables;

	public function __construct()
	{
		add_action('wp_head', array($this, 'register_open_graph'));
		add_action('wp_footer', array($this, 'register_tracking'));

		add_action('after_setup_theme', array($this, 'init_theme'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('wp', array($this, 'remove_header_tags'));

		add_action('widgets_init', array($this, 'register_sidebars'));
		add_action('widgets_init', array($this, 'register_widgets'));

		add_action('init', array($this, 'register_shortcodes'));
		add_action('init', array($this, 'catch_uri'), 15);
	}

	public function init_theme()
	{
		add_theme_support('post-thumbnails');

		$this->register_menus();
		$this->register_image_sizes();
	}

	public function register_menus()
	{
		register_nav_menus(array(
			'top_menu' => _x('Top Menu', 'admin', 'anzo'),
			'footer_menu' => _x('Footer Menu', 'admin', 'anzo')
		));
	}

	public function register_image_sizes()
	{
		#add_image_size('screen-thumb', 160, 80, true);
	}

	public function enqueue_scripts()
	{

	}

	public function remove_header_tags()
	{
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wp_shortlink_wp_head');
	}

	public function register_open_graph()
	{
		$title       = get_bloginfo('name');
		$description = get_bloginfo('description');
		$extra       = '';
		$image       = '';
		$type        = 'website';

		if (is_single()) {
			$title = get_the_title();
		}

		if (is_single() && has_post_thumbnail()) {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
			
			if (isset($thumb[0]) && ! empty($thumb[0]))
				$image = $thumb[0];
		}

		echo "\n\n\t<!--=== OPEN GRAPH TAGS ===-->\n";

		if (! empty ($title))
			echo "\t<meta property='og:title' content='" . esc_attr($title) . "'>\n";

		if (! empty ($description))
			echo "\t<meta property='og:description' content='" . esc_attr($description) . "'>\n";

		if (! empty ($image))
			echo "\t<meta property='og:image' content='" . esc_attr($image) . "'>\n";

		if (! empty ($type))
			echo "\t<meta property='og:type' content='" . esc_attr($type) . "'>\n";

		echo "\t<meta property='og:site_name' content='" . get_bloginfo('name') . "'>\n";
	}

	public function register_tracking()
	{
		echo  "\t" . stripslashes(get_option('owc_ga')) . "\n\n\t";
	}

	public function register_sidebars()
	{
		register_sidebar(array(
			'id'			=> 'standard',
			'name'			=> _x('Standard', 'admin', 'owc'),
			'before_widget'	=> '<article id="%1$s" class="sidebar-module %2$s">',
			'after_widget'	=> '</div></article>',
			'before_title'	=> '<h3 class="title">',
			'after_title'	=> '</h3><div class="content">'
		));
	}

	public function register_widgets()
	{
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');

		foreach (glob(ANZO_INCLUDES . '/widgets/*.php') as $filename) {
			require_once($filename);
			$widget = basename($filename, '.php');
			register_widget($widget);
		}
	}

	public function register_shortcodes()
	{
		foreach (glob(ANZO_INCLUDES . '/shortcodes/*.php') as $filename) {
			require_once($filename);
		}
	}

	public function catch_uri()
	{
		if (is_admin())
			return;
		
		$uri = $_SERVER['REQUEST_URI'];
		$uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $uri);
		$uri = explode('/', $uri);
		$uri = array_values(array_filter($uri));
		
		$this->uri = $uri;

		if (empty($uri))
			return;

		$this->current_action = apply_filters('owc_current_action', isset($uri[1]) ? $uri[1] : '', $uri);
		$this->action_variables = apply_filters('owc_action_variables', array_slice($uri, 2), $uri);
	}
}
