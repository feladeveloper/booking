<?php
/**
 * Grid Property Card
 *
 * Property grid card to be displayed on grid listing page.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
$is_featured = get_post_meta( get_the_ID(), 'REAL_HOMES_featured', true );
$label_text  = get_post_meta( get_the_ID(), 'inspiry_property_label', true );

?>

<div class="rh-ultra-list-card">
    <div class="rh-ultra-list-card-thumb">
		<?php

		get_template_part( 'assets/ultra/partials/properties/card-parts/thumbnail-as-bg' );
		get_template_part( 'assets/ultra/partials/properties/card-parts/media-count', null,['styles_selectors' => 'rh-media-dark'] );
		?>
    </div>
    <div class="rh-ultra-list-card-detail">
        <div class="rh-ultra-list-detail-box">
            <div class="rh-ultra-list-tags-wrapper">
                <div class="rh-ultra-status-box">
					<?php
					if ( function_exists( 'ere_get_property_statuses_ultra' ) ) {
						ere_get_property_statuses_ultra( get_the_ID() );
					}

					if ( isset( $is_featured ) && $is_featured == '1' ) {
						?>
                        <span class="rh-ultra-featured">
                        <?php esc_html_e( 'Featured', 'realhomes-elementor-addon' ); ?>
                    </span>
						<?php
					}
					if ( isset( $label_text ) && ! empty( $label_text ) ) {
						?>
                        <span class="rh-ultra-hot">
                            <?php echo esc_html( $label_text ); ?>
                        </span>
						<?php
					}
					?>
                </div>
				<?php
				get_template_part( 'assets/ultra/partials/properties/card-parts/year-built' );
				?>
            </div>
            <div class="rh-ultra-list-heading-price">
                <div class="rh-ultra-title-address">
					<?php
					get_template_part( 'assets/ultra/partials/properties/card-parts/heading' );
					get_template_part( 'assets/ultra/partials/properties/card-parts/address' );
					?>
                </div>
                <div class="rh-ultra-list-price">
					<?php
					get_template_part( 'assets/ultra/partials/properties/card-parts/price' );
					?>
                </div>
            </div>


        </div>
        <div class="rh-ultra-price-meta-wrapper">
			<?php
			get_template_part( 'assets/ultra/partials/properties/card-parts/grid-card-meta' );
			?>
            <div class="rh-ultra-action-buttons rh-ultra-action-light hover-light">
				<?php
				inspiry_ultra_favorite_button( get_the_ID(), '', '', '/common/images/icons/ultra-favourite.svg' );
				inspiry_add_to_compare_button();
				?>
            </div>
        </div>
    </div>
</div>