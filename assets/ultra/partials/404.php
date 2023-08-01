<?php
/**
 * 404 Page
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	?>
    <div class="rh-page-container container">
        <div class="main-content">
			<?php
			get_template_part( 'assets/ultra/partials/page-head' );

			// Display any contents after the page head and before the contents.
			do_action( 'inspiry_before_page_contents' );
			?>
            <main id="main" class="rh-main main">
                <article class="rh-page-404">
                    <div class="error-404-page">
                        <h2 class="title"><?php esc_html_e( '404', 'framework' ); ?></h2>
                        <p><?php esc_html_e( 'The page you are looking for is not here. Please try top navigation!', 'framework' ); ?></p>
                    </div>
                </article>
            </main>
        </div>
    </div><!-- .rh-page-container -->
	<?php
}

get_footer();