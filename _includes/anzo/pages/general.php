<?php

if (!defined('ABSPATH')) exit;

function anzo_admin_screen_general()
{
	if (isset($_POST['submit']) && check_admin_referer('anzo-general-settings')) {
		update_option('anzo_start_page', (int)$_POST['anzo_start_page']);
		update_option('anzo_footer_copyright', esc_attr($_POST['anzo_footer_copyright']));
		update_option('anzo_social_facebook', esc_attr($_POST['anzo_social_facebook']));
		update_option('anzo_social_twitter', esc_attr($_POST['anzo_social_twitter']));
		update_option('anzo_social_instagram', esc_attr($_POST['anzo_social_instagram']));
		update_option('anzo_social_gplus', esc_attr($_POST['anzo_social_gplus']));
		update_option('anzo_ga', $_POST['anzo_ga']);
	}
?>

	<div class="wrap">
		<h2><?php _ex('Inställningar', 'admin', 'anzo'); ?></h2>
		<form action="" method="post">
			<?php wp_nonce_field('anzo-general-settings'); ?>

			<h3><?php _ex('Allmänt', 'admin', 'anzo'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th><?php _ex('Startsida', 'admin', 'anzo'); ?></th>
					<td>
						<?php wp_dropdown_pages(array('name' => 'anzo_start_page', 'show_option_none' => _x('Ingen sida vald', 'admin', 'anzo'), 'selected' => get_option('anzo_start_page'))); ?>
					</td>
				</tr>
				<tr valign="top">
					<th><?php _ex('Sidfot copyright', 'admin', 'anzo'); ?></th>
					<td>
						<input type="text" name="anzo_footer_copyright" value="<?php echo esc_attr(get_option('anzo_footer_copyright')); ?>" class="large-text">
						<p class="description"><?php _ex('%s kommer att ersättas med året', 'admin', 'anzo'); ?></p>
					</td>
				</tr>
			</table>

			<h3><?php _ex('Sociala Inställningar', 'admin', 'anzo'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th><?php _ex('Facebook Sida', 'admin', 'anzo'); ?></th>
					<td>
						<input type="text" name="anzo_social_facebook" value="<?php echo esc_attr(get_option('anzo_social_facebook')); ?>" class="regular-text">
					</td>
				</tr>
				<tr valign="top">
					<th><?php _ex('Twitter Sida', 'admin', 'anzo'); ?></th>
					<td>
						<input type="text" name="anzo_social_twitter" value="<?php echo esc_attr(get_option('anzo_social_twitter')); ?>" class="regular-text">
					</td>
				</tr>
				<tr valign="top">
					<th><?php _ex('Instagram Sida', 'admin', 'anzo'); ?></th>
					<td>
						<input type="text" name="anzo_social_instagram" value="<?php echo esc_attr(get_option('anzo_social_instagram')); ?>" class="regular-text">
					</td>
				</tr>
				<tr valign="top">
					<th><?php _ex('Google+ Sida', 'admin', 'anzo'); ?></th>
					<td>
						<input type="text" name="anzo_social_gplus" value="<?php echo esc_attr(get_option('anzo_social_gplus')); ?>" class="regular-text">
					</td>
				</tr>
			</table>

			<h3><?php _ex('Analys', 'admin', 'anzo'); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th><?php _ex('Google Analytics', 'admin', 'anzo'); ?></th>
					<td>
						<textarea name="anzo_ga" class="large-text code" rows="6"><?php echo stripslashes(get_option('anzo_ga')); ?></textarea>
					</td>
				</tr>
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _ex('Uppdatera', 'admin', 'anzo'); ?>"></p>
		</form>
	</div>

<?php
	}
?>
