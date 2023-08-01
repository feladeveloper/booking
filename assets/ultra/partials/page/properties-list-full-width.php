<?php

/**
 * Page: Properties List
 *
 * Display properties in List layout.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();


if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	/*
	 * View type as grid layout can also have buttons to display list layout.
	 */

	$view_type = 'list';
	if ( isset( $_GET['view'] ) ) {
		$view_type = $_GET['view'];
	}

	if ( 'list' === $view_type ) {
		get_template_part( 'assets/ultra/partials/properties/list-full-width' );
	} else {
		get_template_part( 'assets/ultra/partials/properties/grid-full-width' );
	}

}
get_footer();
