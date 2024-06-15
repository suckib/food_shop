<?php
//register pickup delivery checkout page block
function register_pickup_delivery_block(){
    register_block_type(
        'wpc/pickup-delivery', array(
			'editor_script' => 'wpc-block-js',
            'render_callback'	=> 'wpc_pickup_delivery_callback',
            'api_version'       => 1,
            'attributes'        => array()
        )
    );
}
add_action('init', 'register_pickup_delivery_block');

// enqueue scripts for block
function pickup_delivery_block_assets() {
	if ( class_exists( 'Wpcafe_Pro' ) && is_checkout() ) {
		wp_enqueue_script('frontend-js-block', \Wpcafe_Pro::assets_url() . 'js/wpc-pro-public.js', [  'jquery', 'wpc-pro-widgets-modal-script', 'wpc-public', 'jquery-timepicker', 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n' ], \Wpcafe_Pro::version());
	}
}
add_action( 'enqueue_block_assets', 'pickup_delivery_block_assets', 999 );

// pickup delivery checkout page block callback
function wpc_pickup_delivery_callback() {
    //check if woocommerce exists
    if ( ! class_exists( 'Woocommerce' ) ) { return; }
    
    return do_shortcode( '[wpc_pickup_delivery_checkout]' );
}
