<?php
function astra_child_enqueue_styles() {
    wp_enqueue_style( 'astra-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'astra-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-parent-style' ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_styles' );

function add_custom_product_accordion() {
    get_template_part( 'woocommerce/single-product/accordion-section' );
}
add_action( 'woocommerce_after_add_to_cart_form', 'add_custom_product_accordion', 10 );

function include_below_fold_template() {
    get_template_part( 'woocommerce/single-product/below-the-fold' );
}
add_action( 'woocommerce_after_single_product_summary', 'include_below_fold_template', 15 );