<?php
/*
Plugin Name: Change Login Page
description: Rebrand easily the login page of your WordPress installation.
Version: 1.0.0
Requires at least: 4.7.9
Author: Jeroen van der Rhee
Author URI: https://jeroenvanderrhee.nl
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/* Settings to manage WP login page */
function clp_register_logo_settings(){

    //Set the arguments
    $args = array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => NULL,
   );

   // Register the settings for the background-image
   register_setting( 'change_login_options_group', 'clp_background_url', $args);

   // Register the settings for the logo's
   register_setting( 'change_login_options_group', 'clp_logo_url', $args);
   register_setting( 'change_login_options_group', 'clp_logo_height', $args);
   register_setting( 'change_login_options_group', 'clp_logo_width', $args);

   // Register the settings for the buttons
   register_setting( 'change_login_options_group', 'clp_primary_color', $args);
   register_setting( 'change_login_options_group', 'clp_primary_text_color', $args);

   //Register the settings to change the textcolors
   register_setting( 'change_login_options_group', 'clp_text_color', $args);
}

// Init the function
add_action( 'admin_init', 'clp_register_logo_settings' );

// Function to register menu on admin page
function clp_register_setting_page() {

  // Add the option to the admin menu
  add_options_page('Change login page', 'Change login page', 'manage_options', 'change-login-page', 'clp_change_wordpress_login_page');
}

// Declare the menu
add_action('admin_menu', 'clp_register_setting_page');

// Function to declare the wordpres login page
function clp_change_wordpress_login_page(){

  // Load JQUERY and media
	wp_enqueue_script('jquery');
	wp_enqueue_media();

  //Include the HTML page
  include("settings_login_page.php");
}

/* Custom WordPress admin login header logo */
function clp_wordpress_custom_login_page() {

  // Get the settings options
  $logo_url=get_option('clp_logo_url');
  $wp_logo_height=get_option('clp_logo_height');
  $wp_logo_width=get_option('clp_logo_width');

  $wp_prim_color=get_option('clp_primary_color');
  $wp_prim_text_color=get_option('clp_primary_text_color');

  $wp_text_color=get_option('clp_text_color');

  // Register the settings for the background-image
  $wp_background=get_option('clp_background_url');

  // Get the image_size
  $image_size = getimagesize($logo_url);

  // Set the values
	if(empty($wp_logo_height)){
		$wp_logo_height=$image_size[1] * 0.8 ."px";
	}
	else{
		$wp_logo_height.='px';
	}
	if(empty($wp_logo_width)){
		$wp_logo_width= $image_size[0] * 0.8 . "px";
	}
	else{
		$wp_logo_width.='px';
  }

  // When the logo url is not empty
	if(!empty($wp_background)){

    // Echo the styling to the page
		echo '<style type="text/css">
            body{
      				background-image:url('.$wp_background.') !important;
              background-position: center center;
              background-repeat: no-repeat;
              background-size: cover;
				   }
        </style>';
	}

  // When the logo url is not empty
	if(!empty($logo_url)){

    // Echo the styling to the page
		echo '<style type="text/css">
            h1 a {
      				background-image:url('.$logo_url.') !important;
      				height:'.$wp_logo_height.' !important;
      				width:'.$wp_logo_width.' !important;
      				background-size:100% !important;
      				line-height:inherit !important;
				   }
        </style>';
	}

  if(!empty($wp_prim_color)){
    // Echo the styling to the page
		echo '<style type="text/css">
        #loginform .button-primary{
          border-color:'.$wp_prim_color.';
          background-color:'.$wp_prim_color.';
        }

         #loginform .button-secondary{
           color:'.$wp_prim_color.';
         }

         #loginform .button-primary.focus, #loginform .button-primary:focus {
           box-shadow: 0 0 0 1px #fff, 0 0 0 3px '.$wp_prim_color.';
         }

         #loginform .button-primary:active{
           border-color:'.$wp_prim_color.';
           background-color:'.$wp_prim_color.';
         }

         input[type=checkbox]:focus, input[type=date]:focus, input[type=datetime-local]:focus, input[type=datetime]:focus, input[type=email]:focus,
         input[type=number]:focus, input[type=password]:focus, input[type=radio]:focus, input[type=search]:focus, input[type=tel]:focus,
         input[type=text]:focus, input[type=url]:focus,select:focus, textarea:focus{
           border-color: '.$wp_prim_color.';
           box-shadow: 0 0 0 1px '.$wp_prim_color.';
         }
        </style>';
  }

  if(!empty($wp_prim_text_color)){
    // Echo the styling to the page
		echo '<style type="text/css">
            #loginform .button-primary{
              color:'.$wp_prim_text_color.';
            }
        </style>';
  }

  if(!empty($wp_text_color)){
    // Echo the styling to the page
		echo '<style type="text/css">
            .login #backtoblog a, .login #nav a, #loginform label, input[type=text]{
              color:'.$wp_text_color.';
            }
        </style>';
  }
}

// Add logo to the page
add_action( 'login_head', 'clp_wordpress_custom_login_page' );

/* Add action links to plugin list*/
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'clp_change_wordpress_login_action_links' );

// Create the link to the settings page
function clp_change_wordpress_login_action_links ( $links ) {

  // Create the settingslink
	$settings_link = array('<a href="' . admin_url( 'options-general.php?page=change-login-page' ) . '">Login Settings</a>');
	return array_merge( $links, $settings_link );

}

/*Change login logo URL*/
add_filter( 'login_headerurl', 'clp_change_login_page_url' );

// Change the url
function clp_change_login_page_url($url) {
	return home_url();
}
?>
