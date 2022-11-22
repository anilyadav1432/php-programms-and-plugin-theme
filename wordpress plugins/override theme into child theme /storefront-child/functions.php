<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css'); //it's for parent theme style.css file
    wp_enqueue_style( 'child-style', get_stylesheet_uri()); //it's for child theme style.css file 
    wp_enqueue_style( 'test-css', get_stylesheet_directory_uri()."/test.css"); //this is custom css file
}

add_filter( 'woocommerce_checkout_fields', 'my_remove_checkout_fields', 10 );
function my_remove_checkout_fields( $fields ) {
    unset( $fields['billing']['billing_last_name'] );
    unset( $fields['billing']['billing_phone'] );
    unset( $fields['billing']['billing_email'] );
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
 {
    // $fields['billing']['billing_first_name']['placeholder'] = 'UserName';
    $fields['billing']['billing_first_name']['label'] = 'Username' ;
    // print_r($fields);  
    return $fields;
 }


 /**
  * it will provide support to override woocommerce file via child theme
  */

//   function mytheme_add_woocommerce_support() {
//     add_theme_support( 'woocommerce' );
//     }
//     add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
    

/**
 * overriding shop page title
 */

add_filter( 'woocommerce_page_title', 'new_woocommerce_page_title');
  
function new_woocommerce_page_title( $page_title ) {
  
  if( $page_title == 'Shop' ) {
  
    return "Child theme Override Shop Title";
  
  }
  
}

/**
 * _____________________this is only guide__________________
 * 
 * Override woocommerce files directly by creating woocommerce folder
 * we can see woocommerce folder into this child theme 
 */
