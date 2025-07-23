<?php
if ( ! function_exists('get_field') ) return;

$title   = get_field('below_title');
$content = get_field('below_content');
$image1   = get_field('below_image_1');
$image2   = get_field('below_image_2');
$btnText   = get_field('below_button_text');
$btnLink   = get_field('below_button_link');

if ( $title || $content || $image1 ) : ?>
    <div class="below-fold-wrapper">
        <div class="below-fold-section">
            <div class="below-fold-text">
                <?php if ( $title ) : ?>
                    <h2 class="below-fold-heading"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>
                <div class="below-fold-content">
                    <?php echo wp_kses_post( $content ); ?>
                </div>
                <?php if ( $btnLink ) : ?>
                <div class="below-fold-btn">
                    <a href="<?php echo esc_url( $btnLink ); ?>" class="button below-fold-button">
                        <?php echo esc_html( $btnText ); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <?php if ( $image1 ) : ?>
                <div class="below-fold-image">
                    <img class="topImage" src="<?php echo esc_url( $image1['url'] ); ?>" alt="<?php echo esc_attr( $image1['alt'] ); ?>">
                    <img class="bottomImage" src="<?php echo esc_url( $image2['url'] ); ?>" alt="<?php echo esc_attr( $image2['alt'] ); ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
