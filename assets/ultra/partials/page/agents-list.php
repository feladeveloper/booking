<?php
/**
 * Page: Agents Listing
 *
 * Page template for agents listing.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	get_template_part( 'assets/ultra/partials/agent/list' );
}

get_footer();