<?php
/*
* Plugin Name: Buy Now Button
* Plugin URI: https://seosthemes.com/buy-now-button
* Description: Simple WordPress Buy Now Button Plugin.
* Contributors: seosbg
* Author: seosbg
* Author URI: https://seosthemes.com/
* Text Domain: buy-now-button
* Version: 1.0
* License: GPL2
*/


/****************************************************
Add Menu
****************************************************/

add_action('admin_menu', 'buy_now_button_menu');

function buy_now_button_menu() {
		add_menu_page('Buy Now Button', 'Buy Now Button', 'administrator', 'buy-now-button-settings', 'buy_now_button_settings_page', plugins_url('images/icon.png' , __FILE__ )
    );

    add_action('admin_init', 'buy_now_button_seos_register_settings');
}

/****************************************************
Admin Enqueue Scripts
****************************************************/

add_action('admin_enqueue_scripts', 'buy_now_button_seos_admin_scripts');

function buy_now_button_seos_admin_scripts() {
 
    wp_enqueue_script('jquery');

	wp_enqueue_media();
	
	wp_enqueue_style('buy_now_button_style', plugin_dir_url(__FILE__) . '/css/admin.css');

	wp_enqueue_script('buy_now_button_script_load', plugin_dir_url(__FILE__) . '/js/admin.js', array(), '', true );

}


/****************************************************
WP Enqueue Scripts
****************************************************/

add_action('wp_enqueue_scripts', 'buy_now_button_wp_scripts');

function buy_now_button_wp_scripts(){
	
	wp_enqueue_style('buy_now_button_style', plugin_dir_url(__FILE__) . '/css/style.css');
		
	wp_enqueue_script('jquery');

}


/****************************************************
Register Settings
****************************************************/

function buy_now_button_seos_register_settings() {
    register_setting('buy-now-button-settings', 'buy_now_button_url');
    register_setting('buy-now-button-settings', 'buy_now_button_text');
}


/****************************************************
Add Form
****************************************************/

function buy_now_button_settings_page() {
?>

    <div class="wrap buy-now-button">

        <form action="options.php" method="post" role="form" name="buy-now-button-form">
		
			<?php settings_fields( 'buy-now-button-settings' ); ?>
			<?php do_settings_sections( 'buy-now-button-settings' ); ?>
		
			<div>
				<a target="_blank" href="http://seosthemes.com/">
					<div class="btn s-red">
						 <?php _e('SEOS', 'buy-now-button'); echo ' <img class="ss-logo" src="' . plugins_url( 'images/logo.png' , __FILE__ ) . '" alt="logo" />';  _e(' THEMES', 'buy-now-button'); ?>
					</div>
				</a>
			</div>
			

	<!-- ------------------------------------------ Buy Now Button ------------------------------------------ -->		
				
			<h1><?php _e('Buy Now Button', 'buy-now-button'); ?></h1>
			<div>	
				<table class="form-table">		
					<tr valign="top">   
						<th scope="row"><?php _e('Buy Now Button URL: ', 'buy-now-button'); ?></th>
						<td>
							<input type="text" name="buy_now_button_url" size="40" value="<?php echo  esc_url(get_option('buy_now_button_url')); ?>">
						</td>
					</tr>
					<tr valign="top">   
						<th scope="row"><?php _e('Buy Now Button Text: ', 'buy-now-button'); ?></th>
						<td>
							<input type="text" name="buy_now_button_text" size="40" value="<?php echo  esc_attr(get_option('buy_now_button_text')); ?>">
						</td>
					</tr>
				</table>
			</div>
			
			<hr />
				
			<div style="margin-top: 20px;"><?php submit_button(); ?></div>
			
		</form>	
	</div>
	
	<?php } 

/****************************************************
Language Load
****************************************************/
	
	function buy_now_button_language_load() {
		load_plugin_textdomain('buy_now_button_language_load', FALSE, basename(dirname(__FILE__)) . '/languages');
	}
	
	add_action('init', 'buy_now_button_language_load');

	
// ************** Add in HEAD **************

	function buy_now_button () { ?>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<div class="bnb-fix">
		<div class="bnb-top">
			
			<a href="<?php echo get_option('buy_now_button_url'); ?>"><?php echo get_option('buy_now_button_text'); ?></a>
		</div>
	</div>
		
	<?php }
	add_action('wp_head','buy_now_button');