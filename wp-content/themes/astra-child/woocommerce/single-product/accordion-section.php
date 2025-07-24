<?php
if ( ! function_exists( 'get_field' ) ) return;

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
                <button class="accordion">
                    <?php echo esc_html( $field['label'] ); ?>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="panelContent"><?php echo wp_kses_post( $field['value'] ); ?></div>
            </div>
        <?php endif;
    endforeach; ?>

    <button id="openQuoteModal" class="accordion">Request a Quote</button>
    <div id="quoteModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span id="closeQuoteModal" class="close">&times;</span>
            <?php echo do_shortcode('[wpforms id="34" title="false"]'); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordions = document.querySelectorAll(".accordion");

        accordions.forEach(function(btn) {
            btn.addEventListener("click", function() {
                this.classList.toggle("active");
                const panel = this.nextElementSibling;
                const icon = this.querySelector(".accordion-icon");

                // Toggle panel visibility
                if (panel && panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                    if (icon) icon.textContent = "+";
                } else if (panel) {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    if (icon) icon.textContent = "−";
                }
            });
        });

        // Modal logic
        const modal = document.getElementById('quoteModal');
        const openBtn = document.getElementById('openQuoteModal');
        const closeBtn = document.getElementById('closeQuoteModal');

        if (openBtn && closeBtn && modal) {
            openBtn.addEventListener('click', () => modal.style.display = 'block');
            closeBtn.addEventListener('click', () => modal.style.display = 'none');
            window.addEventListener('click', (e) => {
                if (e.target === modal) modal.style.display = 'none';
            });
        }
    });

</script>
