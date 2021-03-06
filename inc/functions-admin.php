<?php
/**
 * Hompage admin options
 */

function tna_homepage_menu() {
	add_menu_page( 'Homepage settings', 'Homepage', 'manage_options', 'homepage-admin-page', 'homepage_admin_page', 'dashicons-admin-generic', 21  );

	add_action( 'admin_init', 'homepage_admin_page_settings' );
}

function homepage_admin_page_settings() {
	register_setting( 'homepage-settings-group', 'home_masthead_desc' );
	register_setting( 'homepage-settings-group', 'home_masthead_title' );
	register_setting( 'homepage-settings-group', 'home_masthead_sub_title' );

	for ( $i=1 ; $i<=3 ; $i++ ) {

		register_setting( 'homepage-settings-group', 'home_masthead_btn_text_'.$i );
		register_setting( 'homepage-settings-group', 'home_masthead_btn_url_'.$i );

	}

	for ( $i=1 ; $i<=4 ; $i++ ) {

		register_setting( 'homepage-settings-group', 'home_landing_page_title_'.$i );
		register_setting( 'homepage-settings-group', 'home_landing_page_url_'.$i );
		register_setting( 'homepage-settings-group', 'home_landing_page_text_'.$i );

	}

	for ( $i=1 ; $i<=12 ; $i++ ) {

		register_setting( 'homepage-settings-group', 'open_date_'.$i );
		register_setting( 'homepage-settings-group', 'open_status_'.$i );
		register_setting( 'homepage-settings-group', 'open_times_'.$i );

	}

	register_setting( 'homepage-settings-group', 'home_alert_status' );
	register_setting( 'homepage-settings-group', 'home_alert_title' );
	register_setting( 'homepage-settings-group', 'home_alert_text' );
	register_setting( 'homepage-settings-group', 'home_alert_theme' );
}

function homepage_admin_page() {
	if (!current_user_can('edit_others_pages'))  {
		wp_die( __('<div class="notice notice-error"><p>You do not have sufficient pilchards to access this page.</p></div>') );
	}
	?>
	<div class="wrap tna-homepage">
		<h1>TNA homepage settings</h1>
		<form method="post" action="options.php" novalidate="novalidate">
			<?php settings_fields( 'homepage-settings-group' ); ?>
			<?php do_settings_sections( 'homepage-settings-group' ); ?>

			<h2>Masthead title</h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="home_masthead_title">Title</label></th>
					<td><input type="text" name="home_masthead_title" value="<?php echo esc_attr( get_option('home_masthead_title') ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="home_masthead_sub_title">Sub title</label></th>
					<td><input type="text" name="home_masthead_sub_title" value="<?php echo esc_attr( get_option('home_masthead_sub_title') ); ?>" /></td>
				</tr>
			</table>

			<h2>Masthead buttons</h2>
			<?php for ( $i=1 ; $i<=3 ; $i++ ) { ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label for="home_masthead_btn_text_<?php echo $i; ?>">Button <?php echo $i; ?> label</label></th>
						<td><input type="text" name="home_masthead_btn_text_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('home_masthead_btn_text_'.$i) ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="home_masthead_btn_url_<?php echo $i; ?>">Button <?php echo $i; ?> URL</label></th>
						<td><input type="text" name="home_masthead_btn_url_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('home_masthead_btn_url_'.$i) ); ?>" /></td>
					</tr>
				</table>
			<?php } ?>

			<?php submit_button(); ?>

			<?php for ( $i=1 ; $i<=4 ; $i++ ) { ?>
					<h2>Landing page link card <?php echo $i; ?></h2>
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label for="home_landing_page_title_<?php echo $i; ?>">Title</label></th>
							<td><input type="text" name="home_landing_page_title_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('home_landing_page_title_'.$i) ); ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="home_landing_page_url_<?php echo $i; ?>">URL</label></th>
							<td><input type="text" name="home_landing_page_url_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('home_landing_page_url_'.$i) ); ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="home_landing_page_text_<?php echo $i; ?>">Description</label></th>
							<td><textarea name="home_landing_page_text_<?php echo $i; ?>"><?php echo esc_attr( get_option('home_landing_page_text_'.$i) ); ?></textarea></td>
						</tr>
					</table>
			<?php } ?>

			<?php submit_button(); ?>

			<h2>Opening times override</h2>
			<table class="form-table opening-times">
			<?php for ( $i=1 ; $i<=12 ; $i++ ) { ?>
					<tr valign="top">
						<th scope="row"><label for="open_date_<?php echo $i; ?>">Status / date / times</label></th>
						<td>
							<select name="open_status_<?php echo $i; ?>">
								<option value="disabled">Please select</option>
								<option <?php if (get_option('open_status_'.$i) == 'open') { echo ' selected="selected"'; }; ?> value="open">Open</option>
								<option <?php if (get_option('open_status_'.$i) == 'closed') { echo ' selected="selected"'; }; ?> value="closed">Closed</option>
							</select>
							<input type="date" name="open_date_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('open_date_'.$i) ); ?>" />
							<input type="text" name="open_times_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('open_times_'.$i) ); ?>" />
						</td>
					</tr>
			<?php } ?>
			</table>

			<?php submit_button(); ?>

			<h2>Alert message</h2>
			<table class="form-table home-alert">
				<tr valign="top">
					<th scope="row"><label for="home_alert_status">Homepage alert</label></th>
					<td>
						<select name="home_alert_status">
							<option <?php if (get_option('home_alert_status') == 'disabled') { echo ' selected="selected"'; }; ?> value="disabled">Disabled</option>
							<option <?php if (get_option('home_alert_status') == 'enabled') { echo ' selected="selected"'; }; ?> value="enabled">Enabled</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="home_alert_theme">Theme</label></th>
					<td>
						<select name="home_alert_theme">
							<option <?php if (get_option('home_alert_theme') == 'yellow') { echo ' selected="selected"'; }; ?> value="yellow">Yellow</option>
							<option <?php if (get_option('home_alert_theme') == 'dark') { echo ' selected="selected"'; }; ?> value="dark">Dark</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="home_alert_title">Title</label></th>
					<td><input type="text" name="home_alert_title" value="<?php echo esc_attr( get_option('home_alert_title') ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="home_alert_text">Description</label></th>
					<td><textarea name="home_alert_text"><?php echo esc_attr( get_option('home_alert_text') ); ?></textarea></td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}