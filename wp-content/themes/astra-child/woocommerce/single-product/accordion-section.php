<?php
// Exit early if ACF is not active
if ( ! function_exists( 'get_field' ) ) return;

// Define the ACF field names for the accordion content
$fields = [
    'accordion_1',
    'accordion_2',
    'accordion_3'
];
?>

<!-- Accordion Wrapper -->
<div class="custom-product-accordion">
    <h3>Additional Information</h3>

    <?php
    // Loop through each defined ACF field
    foreach ( $fields as $field_name ) :
        $field = get_field_object( $field_name ); // Get full ACF field object (includes label & value)
        if ( ! empty( $field['value'] ) ) : ?>
            <div class="accordionTab">
                <!-- Accordion Toggle Button -->
                <button class="accordion">
                    <?php echo esc_html( $field['label'] ); ?> <!-- Accordion Label from ACF -->
                    <span class="accordion-icon">+</span> <!-- Icon for open/close -->
                </button>

                <!-- Hidden panel that expands on click -->
                <div class="panelContent">
                    <?php echo wp_kses_post( $field['value'] ); ?> <!-- Safe HTML output of ACF field -->
                </div>
            </div>
        <?php endif;
    endforeach; ?>

    <!-- Request a Quote button that triggers modal -->
    <button id="openQuoteModal" class="accordion">Request a Quote</button>

    <!-- Modal markup, initially hidden -->
    <div id="quoteModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span id="closeQuoteModal" class="close">&times;</span>
            <?php echo do_shortcode('[wpforms id="34" title="false"]'); ?> <!-- Embed WPForms form -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle accordion open/close behavior
    const accordions = document.querySelectorAll(".accordion");

    accordions.forEach(function(btn) {
        btn.addEventListener("click", function() {
            this.classList.toggle("active");

            const panel = this.nextElementSibling;
            const icon = this.querySelector(".accordion-icon");

            // Toggle the visibility and height of the panel
            if (panel && panel.style.maxHeight) {
                panel.style.maxHeight = null;
                if (icon) icon.textContent = "+";
            } else if (panel) {
                panel.style.maxHeight = panel.scrollHeight + "px";
                if (icon) icon.textContent = "−";
            }
        });
    });

    // Modal functionality
    const modal = document.getElementById('quoteModal');
    const openBtn = document.getElementById('openQuoteModal');
    const closeBtn = document.getElementById('closeQuoteModal');

    if (openBtn && closeBtn && modal) {
        // Open modal on button click
        openBtn.addEventListener('click', () => modal.style.display = 'block');

        // Close modal on close button click
        closeBtn.addEventListener('click', () => modal.style.display = 'none');

        // Close modal if user clicks outside of modal content
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.style.display = 'none';
        });
    }
});
</script>

