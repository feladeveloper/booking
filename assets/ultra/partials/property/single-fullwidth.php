<?php
/**
 * Template for Single Property or Property Detail Page
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	$theme_property_detail_variation = get_option( 'theme_property_detail_variation', 'default' );

// Property detail page sections
	$sortable_property_sections = array(
		'content'                   => 'true',
		'additional-details'        => 'true',
		'common-note'               => get_option( 'theme_display_common_note', 'true' ),
		'features'                  => 'true',
		'attachments'               => get_option( 'theme_display_attachments', 'true' ),
		'floor-plans'               => 'true',
		'video'                     => get_option( 'theme_display_video', 'true' ),
		'virtual-tour'              => get_option( 'inspiry_display_virtual_tour', 'false' ),
		'map'                       => get_option( 'theme_display_google_map', 'true' ),
		'walkscore'                 => get_option( 'inspiry_display_walkscore', 'false' ),
		'yelp-nearby-places'        => get_option( 'inspiry_display_yelp_nearby_places', 'false' ),
		'energy-performance'        => get_option( 'inspiry_display_energy_performance', 'true' ),
		'property-views'            => get_option( 'inspiry_display_property_views', 'true' ),
		'rvr/availability-calendar' => get_option( 'inspiry_display_availability_calendar', 'true' ),
		'schedule-a-tour'           => 'true',
		'children'                  => 'true',
		'agent'                     => get_option( 'theme_display_agent_info', 'true' ),
		'mortgage-calculator'       => get_option( 'inspiry_mc_display', 'false' ),
	);

	$sortable_property_sections = apply_filters( 'realhomes_property_default_sections', $sortable_property_sections );

	$property_sections_order = array_keys( $sortable_property_sections );
	$order_settings          = get_theme_mod( 'inspiry_property_sections_order_default', 'default' );
	if ( 'custom' === $order_settings ) {
		$property_sections_order = get_option( 'inspiry_property_sections_order_mod' );
		$property_sections_order = explode( ',', $property_sections_order );
	}


	?>
    <div class="rh-ultra-property-wrapper rh-ultra-property-full-width">
		<?php
		do_action( 'inspiry_before_page_contents' );
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'assets/ultra/partials/property/single/slider-full' );
				if ( ! post_password_required() ) {
					?>

                    <div class="rh-ultra-content-container">
                        <div class="rh-ultra-property-content">

                            <div class="rh-ultra-property-content-box">


								<?php
								get_template_part( 'assets/ultra/partials/property/single/overview' );
								$prop_detail_login = inspiry_prop_detail_login();
								if ( 'yes' == $prop_detail_login && ! is_user_logged_in() ) {
									?>
                                    <div class="rh_form rh_property_detail_login">
										<?php
										get_template_part( 'assets/ultra/partials/member/login-form' );
										get_template_part( 'assets/ultra/partials/member/register-form' );
										?>
                                    </div>
									<?php
								} else {
									get_template_part( 'assets/ultra/partials/property/single/meta-icons' );

									// Display sections according to their order
									if ( ! empty( $property_sections_order ) && is_array( $property_sections_order ) ) {
										foreach ( $property_sections_order as $section ) {
											if ( isset( $sortable_property_sections[ $section ] ) && 'true' === $sortable_property_sections[ $section ] ) {
												get_template_part( 'assets/ultra/partials/property/single/' . $section );
											}
										}
									}
									?>
                                    <section class="rh_property__comments rh-ultra-property-comment">
										<?php

										/**
										 * Comments
										 *
										 * If comments are open or we have at least one comment, load up the comment template.
										 */
										if ( comments_open() || get_comments_number() ) {
											?>
                                            <div class="property-comments">
												<?php comments_template(); ?>
                                            </div>
											<?php
										}
										?>
                                    </section>
									<?php
								}
								?>
                            </div>
                        </div>
                    </div>
					<?php
				}
			}
			?>
            <div class="rh-ultra-content-container">
				<?php
				get_template_part( 'assets/ultra/partials/property/single/similar-properties' );
				?>
            </div>
			<?php
		}
		?>
    </div>
	<?php
}

get_footer();

