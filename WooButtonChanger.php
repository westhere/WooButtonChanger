<?php
/**
* Plugin Name: WooButtonChanger
*/


//Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH','include/advanced-custom-fields-pro/' );
define( 'MY_ACF_URL', 'include/advanced-custom-fields-pro/' );

// Include the ACF plugin.
include( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page(array(
		'page_title' 	=> 'Woo Button Change',
		'menu_title'	=> 'Woo Button Changer',
		'menu_slug' 	=> 'woo-button-change',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5dd92750bc0fb',
		'title' => 'Button Text',
		'fields' => array(
			array(
				'key' => 'field_5dd92761de616',
				'label' => 'Buy Now Text',
				'name' => 'buy_now_text',
				'type' => 'text',
				'instructions' => 'this is for the single item. for example the text that will show on the single product page',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Add to cart',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5dd92ec32ede4',
				'label' => 'Add To Cart',
				'name' => 'add_to_cart',
				'type' => 'text',
				'instructions' => 'this is the text that will be shown on all products when in the shop page.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Add to cart',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'woo-button-change',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	endif;

add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );            // < 2.1
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +
  
function woo_custom_product_add_to_cart_text() {
  
    return __( the_field('add_to_cart', 'option'), 'woocommerce' );
  
}

add_filter( 'add_to_cart_text', 'woo_custom_single_add_to_cart_text' );                // < 2.1
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +
  
function woo_custom_single_add_to_cart_text() {
  
    return __( the_field('buy_now_text', 'option'), 'woocommerce' );
  
}

