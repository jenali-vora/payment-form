<?php
/*
Plugin Name: Dynamic Wise Payment
Description: Wise Payment Currency Conversion
Version: 1.0
Author: Jenali
*/

function wise_payment_enqueue_scripts() {
    wp_enqueue_style('wise-payment-css', plugin_dir_url(__FILE__) . 'assets/css/wise-payment.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('wise-payment-js', plugin_dir_url(__FILE__) . 'assets/js/wise-payment.js', array('jquery'), null, true);

    wp_localize_script('wise-payment-js', 'wise_payment_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'wise_payment_enqueue_scripts');

function wise_payment_form_shortcode() {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'form-template.php');
    return ob_get_clean();
}
add_shortcode('wise_payment', 'wise_payment_form_shortcode');

add_action('wp_ajax_wise_payment_conversion', 'wise_payment_conversion');
add_action('wp_ajax_nopriv_wise_payment_conversion', 'wise_payment_conversion');


function wise_payment_conversion() {
    include_once 'conversion.php';
    wp_die();
}

?>
