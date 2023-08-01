<?php
/**
 * Page: Half Google Map with Properties List
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

// Half Map Based Properties List.
	get_template_part( 'assets/ultra/partials/properties/half-map-list' );

}

get_footer();
