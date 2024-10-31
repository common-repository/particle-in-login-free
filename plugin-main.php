<?php
/*
Plugin Name: Particles in login page
Plugin URI: http://themerose.com/wordpress-plugins/login-page-animation
Description: This plugin will add an awesome particles animation in your wordpress login page. 
Author: ThemeRose
Author URI: http://themerose.com
Version: 1.0
*/


/*Some Set-up*/
define('THEMEROSE_LOGIN_PAGE_ANIMATION', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );



/* Including all files */
function login_page_animation_files() {
wp_enqueue_script('themerose-login-page-animation-main', THEMEROSE_LOGIN_PAGE_ANIMATION.'js/particles.min.js', array(), 1.0, false);
wp_enqueue_script('themerose-login-page-animation-active', THEMEROSE_LOGIN_PAGE_ANIMATION.'js/active.js', array(), 1.0, true);
wp_enqueue_style('login-page-animation-style', THEMEROSE_LOGIN_PAGE_ANIMATION.'css/style.css');
}
add_action( 'login_enqueue_scripts', 'login_page_animation_files' );


function login_page_animation_footer_html(){
    echo'<div id="particles-js"></div>';
}
add_action('login_footer', 'login_page_animation_footer_html');


function login_page_animation_login_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'login_page_animation_login_url' );

function login_page_animation_login_url_title() {
    return get_bloginfo( 'description' );
}
add_filter( 'login_headertitle', 'login_page_animation_login_url_title' );


function add_pilfree_options_framwrork()  
{  
	add_options_page('Particle in login page premium version', '', 'manage_options', 'pil-settings','pil_options_framwrork');  
}  
add_action('admin_menu', 'add_pilfree_options_framwrork');



if ( is_admin() ) : // Load only if we are viewing an admin page

function pil_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'pil_p_options', 'pil_options', 'pil_validate_options' );
}

add_action( 'admin_init', 'pil_register_settings' );




// Function to generate options page
function pil_options_framwrork() {

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>


	
<div class="wrap">
	<style type="text/css">
		.welcome-panel-column p{padding-right:20px}
		.installing_message h2{background: none repeat scroll 0 0 #5FB6A8;
color: #fff;
line-height: 30px;
padding: 20px;
text-align: center;}
	</style>
	<div class="installing_message">
		<h2>Thank you for installing our free plugin</h2>
	</div>
	

	<div class="welcome-panel" id="welcome-panel">
		
		<div class="welcome-panel-content">
			<h3>Want some cool features of this plugin?</h3>
			<p class="about-description">We've added many extra features in our premium version of this plugin. Let see some amazing features.</p>
	<div class="welcome-panel-column-container">
		<div class="welcome-panel-column">
			<h4>Change background color</h4>
			<img src="http://themerose.com/wp-content/uploads/2014/12/login_color.jpg" alt="">
			<p>In premium version of this plugin, you can change background color by using option panel. You can easily add you theme color as background. We've added color picker for adding color. You can use HTML color code there too.</p>
			<a href="http://demo.themerose.com/?theme=ParticleInLogin" target="_blank" class="button button-primary">Click here for watch demo</a>
		</div>
		
		<div class="welcome-panel-column">
			<h4>Change login logo</h4>
			<img src="http://themerose.com/wp-content/uploads/2014/12/login-page.jpg" alt="">
			<p>Want to change wordpress default logo form your site's login page? This plugin allows you changing login page logo with yours. You can add logo easily by using this plugins option panel. </p>
			<a href="http://demo.themerose.com/?theme=ParticleInLogin" target="_blank" class="button button-primary">Click here for watch demo</a>
		</div>
		
		<div class="welcome-panel-column welcome-panel-last">
			<h4>Awesome login screen</h4>
			<img src="http://themerose.com/wp-content/uploads/2014/12/login-page-new.jpg" alt="">
			<p>Are you too bored for everyting seeing wordpress default login page? Its time for change login page with creative &amp; unique login page. This plugin provides you an awesome login page.</p>
			<a href="http://demo.themerose.com/?theme=ParticleInLogin" target="_blank" class="button button-primary">Click here for watch demo</a>
		</div>
	</div>
	
	
	<br/><br/>
		<h3>Cool! you are ready to enable those features in only $5. </h3>
		<p class="about-description">Watch demo before purchase. I know you like the demos. Thanks for reading features. Good luck with awesome login page in your wordpress site.</p>

		<a target="_blank" href="http://themerose.com/release/particle-in-login/" class="button button-primary button-hero">Purchase premium plugin now. Only $5</a><br/><br/>
	
	
		</div>
	</div>


</div>
	


	<?php
}



endif;  // EndIf is_admin()


register_activation_hook(__FILE__, 'pil_redr_activate');
add_action('admin_init', 'pil_redr_redirect');

function pil_redr_activate() {
    add_option('pil_redr_do_activation_redirect', true);
}

function pil_redr_redirect() {
    if (get_option('pil_redr_do_activation_redirect', false)) {
        delete_option('pil_redr_do_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("options-general.php?page=pil-settings");
        }
    }
}

?>