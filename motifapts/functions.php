<?php

add_action ('init', 'init_template');

function init_template(){
  setup_template_theme();
  add_action( 'wp_enqueue_scripts', 'enqueue_template_scripts' );
  add_action( 'wp_enqueue_scripts', 'enqueue_template_styles' );
}

// Override 'Howdy' message, because we're professionals.
function howdy_message($translated_text, $text, $domain) {
  $new_message = str_replace('Howdy', 'Welcome', $text);
  return $new_message;
}
add_filter('gettext', 'howdy_message', 10, 3);


function setup_template_theme(){
	// Set up schema
	add_action('wp_head', 'create_schema');
	function create_schema() {
	  $schema = array(
	    '@context' => "http://schema.org", // Tell search engines that this is structured data
	    '@type' => "ApartmentComplex", // Tell search engines the content type it is looking at 
	    'name' => get_bloginfo('name'), // Provide search engines with the site name and address 
	    'url' => get_home_url(),
	    'address' => array(
	      '@type' => "PostalAddress",
	      'addressCountry' => "United States",
	      'streetAddress' => get_field('address', 'options'),
	      'postalCode' => get_field('zip', 'options'),
	      'addressLocality' => get_field('city', 'options'),
	      'addressRegion' => get_field('state', 'options'),
	      'telephone' => clean_phone(get_field('phone', 'options')),
	      'description' => get_field('schema_description', 'options')
	    ),
	    'telephone' => '+1' . clean_phone(get_field('phone', 'options')) // Provide the company address - needs country code
	  );

	  // If Google Map link exists...
	  if ($map_link = get_field('google_places_map_link', 'options')) {
	  	$schema['map'] = $map_link; // ...then add it to the schema array
		}

	  // If there is a company logo...
	  if ($logo = get_field('logo', 'options')) {
	    $schema['logo'] = $logo['url']; // ...then add it to the schema array
	  }
	  // Check for social media links
	  if (have_rows('social_media_accounts', 'options')) {
	    $schema['sameAs'] = array();  
	    // For each instance...
	    while (have_rows('social_media_accounts', 'options')) : the_row();
	      array_push($schema['sameAs'], get_sub_field('url')); // ...add it to the schema array
	    endwhile;
	  }
	  echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
	}


	// Remove added padding from Admin Bar
	add_action('get_header', 'remove_admin_login_header');
	function remove_admin_login_header() {
	    remove_action('wp_head', '_admin_bar_bump_cb');
	}

  // Setting up theme
  if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    add_theme_support( 'post-thumbnails' );
  }

  if (function_exists('register_sidebar')){
    register_sidebar(array('name'=>'Sidebar %d'));
  }

  if (function_exists('register_nav_menu')) {
    register_nav_menu( 'main_menu', 'Main Menu' );
    register_nav_menu( 'mobile_menu', 'Mobile Menu' );
  }

  if (function_exists('add_image_size')){
    // add_image_size('name', width, height, true);
  }

  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
  }

  // Set Google Maps API for Advanced Custom Fields use
  function my_acf_google_map_api( $api ) {
    $api['key'] = 'AIzaSyDgz1DgAVsU-wnRXfuiwVDi7Alyi6jWoho';
    return $api;
  }
  add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
}

function enqueue_template_styles() {
  // Style Sheet Theme Information
  wp_register_style('style-css', get_bloginfo('template_directory') . '/style.css' );
  wp_enqueue_style('style-css');

  // Core Stylesheet (compiled sass)
  wp_register_style('screen-css', get_bloginfo('template_directory') . '/css/screen.css' );
  wp_enqueue_style('screen-css');

  // MyFonts CSS
  wp_register_style('myfonts-css', get_bloginfo('template_directory') . '/css/MyFontsWebfontsKit.css' );
  wp_enqueue_style('myfonts-css');

    // MyFonts CSS
  wp_register_style('google-css', '//fonts.googleapis.com/css?family=DM+Sans:400,400i,700&display=swap' );
  wp_enqueue_style('google-css');

  // IcoMoon CSS
  wp_register_style('icomoon-css', '//s3.amazonaws.com/icomoon.io/145852/Motif/style.css?iy9vfx' );
  wp_enqueue_style('icomoon-css');

  // Add IE8 Conditional Styles
  wp_enqueue_style( 'ie8-css', get_bloginfo('template_directory') . '/css/ie.css' );
  wp_style_add_data( 'ie8-css', 'conditional', 'lt IE 8' );
}

function enqueue_template_scripts() {
  wp_deregister_script( 'jquery' ); // Google hosted jQuery
  wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js' );
  wp_enqueue_script( 'jquery' );

  wp_deregister_script( 'template-js' ); // Main JS file
  wp_register_script( 'template-js', get_bloginfo('template_directory') . '/js/template.js', array ( 'jquery' ) );
  wp_enqueue_script( 'template-js' );

  // Font Awesome
  wp_register_script( 'font-awesome-js', '//kit.fontawesome.com/d78ff4706e.js' );
  wp_enqueue_script( 'font-awesome-js' );
}

// Adds page slug to Body Class function
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Takes an alphabetic character and returns the phone numeric equivalent
function alpha_to_phone($char){
	$conversion = array('a' => 2, 'b' => 2, 'c' => '2', 'd' => 3, 'e' => 3, 'f' => 3, 'g' => 4, 'h' => 4, 'i' => 4, 'j' => 5, 'k' => 5, 'l' => 5, 'm' => 6, 'n' => 6, 'o' => 6, 'p' => 7, 'q' => 7, 'r' => 7, 's' => 7, 't' => 8, 'u' => 8, 'v' => 8, 'w' => 9, 'x' => 9, 'y' => 9, 'z' => 9);
	return $conversion[$char];
}

// Takes phone number, returns cleaned numeric equivalent for mobile link functionality
function clean_phone($phone){
	$chars = str_split(strtolower($phone));
	$phone = '';
	foreach($chars as $char){
		if (ctype_lower($char)){
			$char = alpha_to_phone($char);
		}
		$phone .= $char;
	}
	$phone = preg_replace("/[^0-9]/", "",$phone);
	return $phone;
}

// Add custom class to jump link menu.
function add_jumplink( $atts, $item, $args ) {
    // Check if the item is in the main menu
    if( $args->theme_location == 'main_menu' ) {
      // Add the desired attributes:
      $atts['class'] = 'jump';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_jumplink', 10, 3 );


// Custom Functions
require_once( get_template_directory() . '/incl/custom-functions.php' );