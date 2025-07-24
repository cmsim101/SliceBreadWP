<?php
/**
 * Enqueue parent and child theme styles.
 */
function astra_child_enqueue_styles() {
    // Load the parent theme stylesheet first
    wp_enqueue_style( 'astra-parent-style', get_template_directory_uri() . '/style.css' );

    // Then load the child theme stylesheet, dependent on the parent
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-parent-style' ), // Parent style is a dependency
        wp_get_theme()->get('Version') // Use the child theme version
    );
}
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_styles' );

/**
 * Load the custom accordion template part below the add to cart form on the product page.
 */
function add_custom_product_accordion() {
    get_template_part( 'woocommerce/single-product/accordion-section' );
}
add_action( 'woocommerce_after_add_to_cart_form', 'add_custom_product_accordion', 10 );

/**
 * Load the "Below the Fold" section template part after the product summary.
 */
function include_below_fold_template() {
    get_template_part( 'woocommerce/single-product/below-the-fold' );
}
add_action( 'woocommerce_after_single_product_summary', 'include_below_fold_template', 15 );
