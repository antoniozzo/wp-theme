<?php namespace ANZO\Classes;

if (!defined('ABSPATH')) exit;

require_once(ANZO_INCLUDES . '/anzo/pages/general.php');

class Admin {
	var $post_id;

	public function __construct()
	{
		$this->set_post_id();

		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('admin_menu', array($this, 'dashboard'));

		add_action('admin_init', array($this, 'prevent_admin'));
		add_action('admin_init', array($this, 'add_rw_meta_boxes'));

		add_filter('admin_post_thumbnail_html', array($this, 'featured_image_description'));
		add_filter('tiny_mce_before_init', array($this, 'tiny_mce_before_init'));
		add_filter('mce_buttons', array($this, 'mce_buttons'));
	}

	public function set_post_id()
	{
		$this->post_id = 0;

		if (isset($_GET['post']))
			$this->post_id = $_GET['post'];

		if (isset($_POST['post_ID']))
			$this->post_id = $_POST['post_ID'];

		if (isset($_REQUEST['post_id']))
			$this->post_id = $_REQUEST['post_id'];
	}

	public function prevent_admin()
	{
		if (!defined('DOING_AJAX') && is_admin() && !current_user_can('edit_posts')) {
			wp_redirect(home_url());
			exit;
		}
	}

	public function admin_menu()
	{
		remove_menu_page('edit-comments.php');

		add_menu_page(get_bloginfo('name'), get_bloginfo('name'), 'manage_options', 'anzo', 'anzo_admin_screen_general', false, 110);
		add_submenu_page('anzo', _x('Settings', 'admin', 'anzo'), _x('Inställningar', 'admin', 'anzo'), 'manage_options', 'anzo', 'anzo_admin_screen_general');
	}

	public function dashboard()
	{
		#remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		#remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	}

	public function add_rw_meta_boxes()
	{
		if (!class_exists('RW_Meta_Box'))
			return;

		$meta_box = array(
			'id'     => 'additional',
			'title'  => _x('Additional', 'admin', 'anzo'),
			'pages'  => array('attachment'),
			'fields' => array(
				array(
					'name' => _x('Link', 'admin', 'anzo'),
					'id'   => 'link',
					'type' => 'text'
				),
				array(
					'name' => _x('Target', 'admin', 'anzo'),
					'id'   => 'link_target',
					'type' => 'select',
					'options' => array(
						''       => _x('Same window', 'admin', 'anzo'),
						'_blank' => _x('New window', 'admin', 'anzo')
					)
				)
			)
		);
		new \RW_Meta_Box($meta_box);

		// Frontpage
		if ($this->post_id === get_option('anzo_start_page')) {
			$meta_box = array(
				'id'     => 'additional',
				'title'  => _x('Additional Information', 'admin', 'anzo'),
				'pages'  => array('page'),
				'fields' => array(
					array(
						'name' => _x('Meta field', 'admin', 'anzo'),
						'id'   => 'meta_field',
						'type' => 'text',
					)
				)
			);
			new \RW_Meta_Box($meta_box);
		}
	}

	public function featured_image_description($content)
	{
		if (get_post_type($this->post_id) == 'featured')
			$content .= '<p class="description">' . _x('Image description', 'admin', 'anzo') . '</p>';

		return $content;
	}

	public function tiny_mce_before_init($settings)
	{
		$settings['theme_advanced_styles'] = 'Preamble=preamble';

		return $settings;
	}

	public function mce_buttons($settings)
	{
		$settings[] = 'styleselect';

		return $settings;
	}
}
