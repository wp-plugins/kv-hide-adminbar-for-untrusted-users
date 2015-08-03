
<?php
/*
Plugin Name: KV Hide AdminBar For Untrusted Users
Plugin URI: http://kvcodes.com
Description: A simple wordpress plugin to Hide your Adminbar on your site front end for logged in users.   <a href="http://www.kvcodes.com" target="_blank" > Read more </a> 
Version: 1.0
Author: kvvaradha
Author URI: http://profiles.wordpress.org/kvvaradha
*/

define('KV_HIDE_ADMINBAR_URL', plugin_dir_url( __FILE__ ));


if(!function_exists('kv_admin_menu')) {
	function kv_admin_menu() { 		
		add_menu_page('Kvcodes', 'Kvcodes', 'manage_options', 'kvcodes' , 'kv_codes_plugins', KV_HIDE_ADMINBAR_URL.'/images/kv_logo.png', 66);	
		add_submenu_page( 'kvcodes', 'KV Hide Adminbar', 'KV Hide Adminbar', 'manage_options', 'kv_hide_adminbar', 'kv_hide_adminbar_admin_settings' );
	}
	add_action('admin_menu', 'kv_admin_menu');


	function kv_codes_plugins() {	?>
	 <div class="wrap">
		<div class="icon32" id="icon-tools"><br/></div>
		<h2><?php _e('KvCodes', 'kvcodes') ?></h2>		
		<div class="welcome-panel">
			Thank you for using Kvcodes Plugins . Here is my few Plugins work .MY plugins are very light weight and Simple.  <p>
			<a href="http://www.kvcodes.com/" target="_blank" ><h3> Visit My Blog</h3></a></p> 
		</div> 
		
		<div id="poststuff" > 
			<div id="post-body" class="metabox-holder columns-2" >
				<div id="post-body-content" > 
					<div class="meta-box-sortables"> 
						<div id="dashboard_right_now" class="postbox">
							<div class="handlediv" > <br> </div>
							<h3 class="hndle"  ><img src="<?php echo KV_HIDE_ADMINBAR_URL.'/images/kv_logo.png'; ?>" >  My plugins </h3> 
							<div class="inside" style="padding: 10px; "> 								
								<?php $kv_wp =  kv_get_web_page('http://profiles.wordpress.org/kvvaradha'); 
										
										 $kv_first_pos = strpos($kv_wp['content'], '<div id="content-plugins" class="info-group plugin-theme main-plugins inactive">');
										
										$kv_first_trim = substr($kv_wp['content'] , $kv_first_pos ); 
											
										$kv_sec_pos = strpos($kv_first_trim, '</div>');
										
										$kv_sec_trim = substr($kv_first_trim ,0, $kv_sec_pos );  
										
										echo $kv_sec_trim; 	?> 
							</div>
						</div>
					</div>							
				</div>
			</div>
		</div> 			
		<div id="postbox-container-1" class="postbox-container" > 
			<div class="meta-box-sortables"> 
				<div id="postbox-container-2" class="postbox-container" >
					<div id="dashboard_right_now" class="postbox">
						<div class="handlediv" > <br> </div>
						<h3 class="hndle" ><img src="<?php echo KV_HIDE_ADMINBAR_URL.'/images/kv_logo.png'; ?>" >  Donate </h3> 
						<div class="inside" style="padding: 10px; " > 
							<b>If i helped you, you can buy me a coffee, just press the donation button :)</b> 
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_donations" />
								<input type="hidden" name="business" value="<?php echo 'kvvaradha@gmail.com'; ?>" />
								<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div> 
					</div> 
				</div>
				<div id="postbox-container-2" class="postbox-container" > 
					<div id="dashboard_quick_press" class="postbox">
						<div class="handlediv" > <br> </div>
						<h3 class="hndle" ><img src="<?php echo KV_HIDE_ADMINBAR_URL.'/images/kv_logo.png'; ?>" >  Support me from Facebook </h3> 
						<div class="inside" style="padding: 10px; "> 
							<p><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fkvcodes&amp;width=180&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false&amp;appId=117935585037426" style="border:none; overflow:hidden; width:250px; height:300px;"></iframe></p>
						</div> 
					</div> 
				</div>
			</div>
		</div> 				
	</div> <!-- /wrap -->
	<?php
	}

	function kv_get_web_page( $url ){
		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle compressed
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );

		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $header;
	}

	add_action( 'admin_print_styles', 'kv_admin_css' );
	function kv_admin_css() {
		 wp_enqueue_style("kvcodes_admin", KV_HIDE_ADMINBAR_URL."/kv_admi_style.css", false, "1.0", "all");
	}

} else {
	function kv_admin_submenu_kv_hide_adminbar_page() { 		
		add_submenu_page( 'kvcodes', 'KV Hide Adminbar', 'KV Hide Adminbar', 'manage_options', 'kv_hide_adminbar', 'kv_hide_adminbar_admin_settings' );
	}
	add_action('admin_menu', 'kv_admin_submenu_kv_hide_adminbar_page');	
}

add_action('admin_init', 'kv_admin_hide_adminbar_register');

function kv_admin_hide_adminbar_register() {	
	register_setting('kvcodes' , 'kv_disable');
	register_setting('kvcodes' , 'kv_except_admin_disable');	
//	register_setting('kvcodes' , 'kv_post_status');
}

function kv_hide_adminbar_admin_settings() { ?>
	<div class="wrap">
        <div class="icon32" id="icon-tools"><br/></div>
        <h2><?php _e('KV Hide AdminBar', 'kvcodes') ?></h2>

		<div id="dashboard-widget-wrap" >
			<div id="dashboard-widgets" class="metabox-holder columns-2" >
				<div id="postbox-container-1" class="postbox-container" > 
					<div class="meta-box-sortables"> 
						<div id="dashboard_right_now" class="postbox">
							<div class="handlediv" > <br> </div>
							<h3 class="hndle" >KV Hide AdminBar</h3> 
							<div class="inside" style="padding: 10px; " >	
								<form method="post" action="options.php">
								    <?php settings_fields( 'kvcodes' ); ?>
								    <?php do_settings_sections( 'kvcodes' ); ?>
								    <table class="form-table">								                 
								        <tr valign="top">
								        <th scope="row">Disable Adminbar for all the users ( Front-end) * :</th>
										<td> <select name="kv_disable" >
											<option value="Yes" <?php if(get_option('kv_disable') == 'Yes') echo 'selected' ; ?>> Yes </option>
											<option value="No" <?php if(get_option('kv_disable') == 'No') echo 'selected' ; ?>> No </option>
										</select> </td>
								        </tr>
								        
										<tr valign="top">
								        <th scope="row">Disable Adminbar Except Administrator </th>
								        <td>
										<select name="kv_except_admin_disable" >
											<option value="true" <?php if(get_option('kv_except_admin_disable') == 'true') echo 'selected' ; ?>> Yes </option>
											<option value="false" <?php if(get_option('kv_except_admin_disable') == 'false') echo 'selected' ; ?>> No </option>
										</select> </td>
										</tr>	
										
								    </table>								    
								    <?php submit_button(); ?>
								</form>
							</div> 
						</div> 
					</div>
				</div> 
			</div>
		</div> 
	</div> <!-- /wrap -->
<?php } 

add_action  ( 'init',  'kv_adminbar_front_disable_adminbar' );
function kv_adminbar_front_disable_adminbar() { 
	if(get_option('kv_disable') == 'Yes'){
		show_admin_bar( false );
		wp_dequeue_script('admin-bar');
		wp_dequeue_style('admin-bar'); 		
		wp_enqueue_script('jquery'); 	
	}
	if(get_option('kv_except_admin_disable') == 'true') {
		if( !current_user_can( 'administrator' ) ) {
			show_admin_bar( false );
			wp_dequeue_script('admin-bar');
			wp_dequeue_style('admin-bar'); 		
			wp_enqueue_script('jquery'); 
		}
	}
	
}
