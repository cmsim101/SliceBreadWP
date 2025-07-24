<?php
// Exit if ACF's get_field function is not available (ACF plugin not active)
if ( ! function_exists('get_field') ) return;

// Get ACF field values
$title     = get_field('below_title');
$content   = get_field('below_content');
$image1    = get_field('below_image_1');
$image2    = get_field('below_image_2');
$btnText   = get_field('below_button_text');
$btnLink   = get_field('below_button_link');

// Only output the section if at least one of the fields has content
if ( $title || $content || $image1 || $image2 ) : ?>
    
    <div class="below-fold-wrapper">
        <div class="below-fold-section">

            <!-- Text content section -->
            <div class="below-fold-text">

                <?php if ( $title ) : ?>
                    <!-- Display the section title -->
                    <h2 class="below-fold-heading"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <div class="below-fold-content">
                    <!-- Display the main content -->
                    <?php echo wp_kses_post( $content ); ?>
                </div>

                <?php if ( $btnLink ) : ?>
                    <!-- Button with link, only shown if link field is set -->
                    <div class="below-fold-btn">
                        <a href="<?php echo esc_url( $btnLink ); ?>" class="button below-fold-button">
                            <?php echo esc_html( $btnText ); ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Image section -->
            <?php if ( $image1 || $image2 ) : ?>
                <div class="below-fold-image">
                    <!-- Display first image (top level) -->
                    <img class="topImage" src="<?php echo esc_url( $image1['url'] ); ?>" alt="<?php echo esc_attr( $image1['alt'] ); ?>">

                    <!-- Display second image (bottom level) -->
                    <img class="bottomImage" src="<?php echo esc_url( $image2['url'] ); ?>" alt="<?php echo esc_attr( $image2['alt'] ); ?>">
                </div>
            <?php endif; ?>

        </div>
    </div>

<?php endif; ?>

