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
    if ( ! function_exists( 'get_field' ) ) {
        return; // ACF not active
    }

    // Get ACF fields and their objects
    $fields = [
        'accordion_1',
        'accordion_2',
        'accordion_3'
    ];

    ?>
    <div class="custom-product-accordion">
        <h3>Additional Information</h3>

        <?php foreach ( $fields as $field_name ) :
            $field = get_field_object( $field_name );
            if ( ! empty( $field['value'] ) ) : ?>
                <div class="accordionTab">
                    <button class="accordion"><?php echo esc_html( $field['label'] ); ?></button>
                    <div class="panel"><?php echo wp_kses_post( $field['value'] ); ?></div>
                </div>
            <?php endif;
        endforeach; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accordions = document.querySelectorAll(".accordion");
            accordions.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    this.classList.toggle("active");
                    const panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    } else {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                    }
                });
            });
        });
    </script>
    <?php
}
add_action( 'woocommerce_after_add_to_cart_form', 'add_custom_product_accordion', 10 );


