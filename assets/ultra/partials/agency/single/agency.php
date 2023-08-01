<?php
/**
 * Single Agency
 *
 * Template for single agency.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

?>
    <div class="rh-page-container container">
        <div class="row">
            <div class="col-8 main-content">
				<?php
				get_template_part( 'assets/ultra/partials/page-head' );

				// Display any contents after the page head and before the contents.
				do_action( 'inspiry_before_page_contents' );
				?>
                <main id="main" class="rh-main main">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();

							get_template_part( 'assets/ultra/partials/agency/single/card' );
						}
					}
					?>

                    <div class="agency-contact-form-wrapper">
                        <h3 class="agency-contact-form-heading rh-page-heading"><?php esc_html_e( 'Contact us', 'framework' ); ?></h3>
						<?php get_template_part( 'assets/ultra/partials/agency/single/contact-form' ); ?>
                    </div>

                    <h3 class="agency-agents-heading rh-page-heading"><?php esc_html_e( 'Our Agents', 'framework' ); ?></h3>
                    <div class="agency-agents">
						<?php
						$paged = 1;
						if ( get_query_var( 'paged' ) ) {
							$paged = get_query_var( 'paged' );
						}

						$number_of_properties = get_option( 'inspiry_number_of_agents_agency', '6' );

						$agency_agents_args = array(
							'post_type'      => 'agent',
							'posts_per_page' => intval( $number_of_properties ),
							'meta_query'     => array(
								array(
									'key'     => 'REAL_HOMES_agency',
									'value'   => get_the_ID(),
									'compare' => '=',
								),
							),
							'paged'          => $paged,
						);

						$agency_agents_query = new WP_Query( apply_filters( 'realhomes_agency_agents', $agency_agents_args ) );

						if ( $agency_agents_query->have_posts() ) {
							$args = array(
								'excerpt' => true,
							);
							while ( $agency_agents_query->have_posts() ) {
								$agency_agents_query->the_post();

								get_template_part( 'assets/ultra/partials/agent/card', '', $args );
							}

							inspiry_theme_pagination( $agency_agents_query->max_num_pages );

							wp_reset_postdata();
						} else {
							?>
                            <div class="rh-alert-wrapper">
                                <h6 class="no-results"><?php esc_html_e( 'No Agent Found!', 'framework' ) ?></h6>
                            </div>
							<?php
						}
						?>
                    </div>
                </main>
            </div>
			<?php
			if ( is_active_sidebar( 'agency-sidebar' ) ) {
				?>
                <div class="col-4 sidebar-content">
					<?php get_sidebar( 'agency' ); ?>
                </div>
				<?php
			}
			?>
        </div>
    </div><!-- .rh-page-container -->
<?php
get_footer();