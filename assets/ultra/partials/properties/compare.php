<?php
/**
 * Property: Compare Properties Template
 *
 * Page template for compare properties.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

$count              = 0;
$compare_list_items = '';
$compare_properties = array();

if ( isset( $_GET['id'] ) ) {
	$compare_list_items = sanitize_text_field( $_GET['id'] );
	$compare_list_items = explode( ',', $compare_list_items );
}

if ( ! empty( $compare_list_items ) ) {
	foreach ( $compare_list_items as $compare_list_item ) {

		if ( 4 === $count ) {
			break;
		}

		$compare_property = get_post( $compare_list_item );
		if ( isset( $compare_property->ID ) ) {
			$thumbnail_id = get_post_thumbnail_id( $compare_property->ID );
			if ( isset( $thumbnail_id ) && ! empty( $thumbnail_id ) ) {
				$compare_property_img = wp_get_attachment_image_src(
					get_post_meta( $compare_property->ID, '_thumbnail_id', true ), 'property-thumb-image'
				);
			} else {
				$compare_property_img[0] = get_inspiry_image_placeholder_url( 'property-thumb-image' );
			}
			$compare_property_permalink = get_permalink( $compare_property->ID );
			$compare_properties[]       = array(
				'ID'        => $compare_property->ID,
				'title'     => $compare_property->post_title,
				'img'       => $compare_property_img,
				'permalink' => $compare_property_permalink,
			);
		}

		$count++;
	}
}
?>
    <section class="rh-page-container container rh-ultra-compare-properties">
		<?php get_template_part( 'assets/ultra/partials/page-head' ); ?>
        <div class="rh-ultra-compare-properties-inner">
			<?php
			do_action( 'inspiry_before_page_contents' );

			// Display page content area at top
			do_action( 'realhomes_content_area_at_top' );

			if ( ! empty( $compare_list_items ) && ! empty( $compare_properties ) ) {
				$comparable_fields = get_option( 'realhomes_comparable_property_fields', array_keys( realhomes_get_comparable_property_fields() ) );
				$compare_head_type = get_option( 'realhomes_compare_head_type', 'sticky' );
				$sticky_head_type  = get_option( 'realhomes_compare_sticky_head_type', 'default' );

				$column_classes = '';
				if ( 'sticky' === $compare_head_type && 'default' === $sticky_head_type ) {
					$column_classes .= 'rh-compare-properties-head-top sticky-compare-head';
				}
				?>
                <div class="rh-compare-properties-wrapper">
                    <div class="rh-compare-properties-head <?php echo esc_attr( $column_classes ); ?>">
                        <div class="property-thumbnail"></div>
						<?php
						foreach ( $compare_properties as $compare_property ) {
							$property_id = $compare_property['ID'];
							?>
                            <div class="property-thumbnail">
								<?php
								if ( in_array( 'thumbnail', $comparable_fields ) ) {
									$compare_property_thumb = $compare_property['img'];
									if ( ! empty( $compare_property_thumb ) ) {
										?>
                                        <a class="thumbnail" href="<?php echo esc_attr( $compare_property['permalink'] ); ?>">
                                            <img src="<?php echo esc_attr( $compare_property_thumb[0] ); ?>" width="<?php echo isset( $compare_property_thumb[1] ) ? esc_attr( $compare_property_thumb[1] ) : '100%'; ?>" height="<?php echo isset( $compare_property_thumb[2] ) ? esc_attr( $compare_property_thumb[2] ) : 'auto'; ?>">
                                        </a>
										<?php
									}
								}

								if (  'normal' === $compare_head_type || ( 'sticky' === $compare_head_type && 'default' === $sticky_head_type ) ) {
									if ( in_array( 'title', $comparable_fields ) ) {
										?>
                                        <h5 class="property-title"><a href="<?php echo esc_attr( $compare_property['permalink'] ); ?>"><?php echo esc_html( $compare_property['title'] ); ?></a></h5>
										<?php
									}

									if ( in_array( 'status', $comparable_fields ) ) {
										?>
                                        <h5 class="property-status"><?php echo esc_html( display_property_status( $property_id ) ); ?></h5>
										<?php
									}

									if ( in_array( 'price', $comparable_fields ) ) {
										?>
                                        <div class="property-price">
                                            <p>
												<?php
												if ( function_exists( 'ere_get_property_price' ) ) {
													echo esc_html( ere_get_property_price( $property_id ) );
												}
												?>
                                            </p>
                                        </div>
										<?php
									}
								}
								?>
                            </div>
							<?php
						}
						?>
                    </div>
					<?php
					if ( 'sticky' === $compare_head_type && 'smart' === $sticky_head_type ) {
						?>
                        <div class="rh-compare-properties-head rh-compare-properties-head-bottom sticky-head-smart">
                            <div class="rh-compare-properties-head-column"></div>
							<?php
							foreach ( $compare_properties as $compare_property ) {
								$property_id = $compare_property['ID'];
								?>
                                <div class="rh-compare-properties-head-column">
									<?php

									if ( in_array( 'title', $comparable_fields ) ) {
										?>
                                        <h5 class="property-title"><a href="<?php echo esc_attr( $compare_property['permalink'] ); ?>"><?php echo esc_html( $compare_property['title'] ); ?></a></h5>
										<?php
									}

									if ( in_array( 'status', $comparable_fields ) ) {
										?>
                                        <h5 class="property-status"><?php echo esc_html( display_property_status( $property_id ) ); ?></h5>
										<?php
									}

									if ( in_array( 'price', $comparable_fields ) ) {
										?>
                                        <div class="property-price">
                                            <p>
												<?php
												if ( function_exists( 'ere_get_property_price' ) ) {
													echo esc_html( ere_get_property_price( $property_id ) );
												}
												?>
                                            </p>
                                        </div>
										<?php
									}

									?>
                                </div>
								<?php
							}
							?>
                        </div>
						<?php
					}
					?>

                    <div class="rh-compare-properties-row">
                        <div class="rh-compare-properties-column heading">
							<?php
							if ( in_array( 'type', $comparable_fields ) ) {
								?>
                                <p><?php esc_html_e( 'Type', 'framework' ); ?></p>

								<?php
							}

							if ( in_array( 'location', $comparable_fields ) ) {
								?>
                                <p><?php esc_html_e( 'Location', 'framework' ); ?></p>
								<?php
							}

							if ( in_array( 'lot-size', $comparable_fields ) ) {
								?>
                                <p>
									<?php
									if ( ! empty( get_option( 'inspiry_lot_size_field_label' ) ) ) {
										echo esc_html( get_option( 'inspiry_lot_size_field_label' ) );
									} else {
										esc_html_e( 'Lot Size', 'framework' );
									}
									?>
                                </p>
								<?php
							}

							if ( in_array( 'property-size', $comparable_fields ) ) {
								?>
                                <p>
									<?php
									if ( ! empty( get_option( 'inspiry_area_field_label' ) ) ) {
										echo esc_html( get_option( 'inspiry_area_field_label' ) );
									} else {
										esc_html_e( 'Property Size', 'framework' );
									}
									?>
                                </p>
								<?php
							}

							if ( in_array( 'property-id', $comparable_fields ) ) {
								?>
                                <p>
									<?php
									if ( ! empty( get_option( 'inspiry_prop_id_field_label' ) ) ) {
										echo esc_html( get_option( 'inspiry_prop_id_field_label' ) );
									} else {
										esc_html_e( 'Property ID', 'framework' );
									}
									?>
                                </p>
								<?php
							}

							if ( in_array( 'year-built', $comparable_fields ) ) {
								?>
                                <p>
									<?php
									if ( ! empty( get_option( 'inspiry_year_built_field_label' ) ) ) {
										echo esc_html( get_option( 'inspiry_year_built_field_label' ) );
									} else {
										esc_html_e( 'Year Built', 'framework' );
									}
									?>
                                </p>
								<?php
							}

							if ( in_array( 'bedrooms', $comparable_fields ) ) {
								?>
                                <p>
									<?php
									if ( ! empty( get_option( 'inspiry_bedrooms_field_label' ) ) ) {
										echo esc_html( get_option( 'inspiry_bedrooms_field_label' ) );
									} else {
										esc_html_e( 'Bedrooms', 'framework' );
									}
									?>
                                </p>
								<?php
							}

							if ( in_array( 'bathrooms', $comparable_fields ) ) {
								?>
                                <p>
									<?php
									if ( ! empty( get_option( 'inspiry_bathrooms_field_label' ) ) ) {
										echo esc_html( get_option( 'inspiry_bathrooms_field_label' ) );
									} else {
										esc_html_e( 'Bathrooms', 'framework' );
									}
									?>
                                </p>
								<?php
							}

							if ( in_array( 'garages', $comparable_fields ) ) {
								?>
                                <p>
									<?php
									if ( ! empty( get_option( 'inspiry_garages_field_label' ) ) ) {
										echo esc_html( get_option( 'inspiry_garages_field_label' ) );
									} else {
										esc_html_e( 'Garages', 'framework' );
									}
									?>
                                </p>
								<?php
							}

							if ( in_array( 'features', $comparable_fields ) ) {

								if ( class_exists( 'ERE_Data' ) ) {
									$all_features = ERE_Data::get_features_slug_name();
									if ( ! empty( $all_features ) ) {
										foreach ( $all_features as $feature ) {
											?>
                                            <p><?php echo esc_html( $feature ); ?></p>
											<?php
										}
									}
								}
							}

							if ( in_array( 'additional-fields', $comparable_fields ) ) {
								do_action( 'ere_compare_additional_property_fields', true );
							}
							?>
                        </div><!-- .rh-compare-properties-column -->
						<?php
						foreach ( $compare_properties as $compare_property ) {
							$property_id    = $compare_property['ID'];
							$post_meta_data = get_post_custom( $property_id );
							?>
                            <div class="rh-compare-properties-column details">
								<?php
								if ( in_array( 'type', $comparable_fields ) ) {
									?>
                                    <p class="property-type">
										<?php
										$compare_property_types = get_the_term_list( $property_id, 'property-type', '', ',', '' );
										if ( ! empty( $compare_property_types ) && ! is_wp_error( $compare_property_types ) ) {
											$compare_property_types = strip_tags( $compare_property_types );
											echo esc_html( $compare_property_types );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'location', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										$compare_property_cities = wp_get_object_terms(
											$property_id, 'property-city'
										);
										if ( empty( $compare_property_cities ) || is_wp_error( $compare_property_cities ) ) {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										} else {
											$compare_property_cities = array_reverse(
												$compare_property_cities
											);
											foreach ( $compare_property_cities as $compare_property_city ) {
												echo esc_html( $compare_property_city->name );
												break;
											}
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'lot-size', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										if ( ! empty( $post_meta_data['REAL_HOMES_property_lot_size'][0] ) ) {
											$prop_size             = $post_meta_data['REAL_HOMES_property_lot_size'][0];
											$prop_lot_size_postfix = '';
											if ( ! empty( $post_meta_data['REAL_HOMES_property_lot_size_postfix'][0] ) ) {
												$prop_lot_size_postfix = $post_meta_data['REAL_HOMES_property_lot_size_postfix'][0];
											}
											echo esc_html( $prop_size . ' ' . $prop_lot_size_postfix );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'property-size', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										if ( ! empty( $post_meta_data['REAL_HOMES_property_size'][0] ) ) {
											$prop_size         = $post_meta_data['REAL_HOMES_property_size'][0];
											$prop_size_postfix = '';
											if ( ! empty( $post_meta_data['REAL_HOMES_property_size_postfix'][0] ) ) {
												$prop_size_postfix = $post_meta_data['REAL_HOMES_property_size_postfix'][0];
											}
											echo esc_html( $prop_size . ' ' . $prop_size_postfix );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'property-id', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										if ( ! empty( $post_meta_data['REAL_HOMES_property_id'][0] ) ) {
											$prop_id = $post_meta_data['REAL_HOMES_property_id'][0];
											echo esc_html( $prop_id );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'year-built', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										if ( ! empty( $post_meta_data['REAL_HOMES_property_year_built'][0] ) ) {
											$prop_year_built = floatval( $post_meta_data['REAL_HOMES_property_year_built'][0] );
											echo esc_html( $prop_year_built );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'bedrooms', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										if ( ! empty( $post_meta_data['REAL_HOMES_property_bedrooms'][0] ) ) {
											$prop_bedrooms = floatval( $post_meta_data['REAL_HOMES_property_bedrooms'][0] );
											echo esc_html( $prop_bedrooms );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'bathrooms', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										if ( ! empty( $post_meta_data['REAL_HOMES_property_bathrooms'][0] ) ) {
											$prop_bathrooms = floatval( $post_meta_data['REAL_HOMES_property_bathrooms'][0] );
											echo esc_html( $prop_bathrooms );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'garages', $comparable_fields ) ) {
									?>
                                    <p>
										<?php
										if ( ! empty( $post_meta_data['REAL_HOMES_property_garage'][0] ) ) {
											$prop_garages = floatval( $post_meta_data['REAL_HOMES_property_garage'][0] );
											echo esc_html( $prop_garages );
										} else {
											?>
                                            <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
											<?php
										}
										?>
                                    </p>
									<?php
								}

								if ( in_array( 'features', $comparable_fields ) ) {

									$property_feature_terms = get_the_terms(
										$property_id, 'property-feature'
									);

									$property_features = array();
									if ( is_array( $property_feature_terms ) && ! is_wp_error( $property_feature_terms ) ) {
										foreach ( $property_feature_terms as $property_feature_term ) {
											$property_features[] = $property_feature_term->name;
										}
									}

									$feature_names = array();
									if ( class_exists( 'ERE_Data' ) ) {
										$property_feature_values = ERE_Data::get_features_slug_name();
										if ( ! empty( $property_feature_values ) ) {
											foreach ( $property_feature_values as $property_feature_value ) {
												$feature_names[] = $property_feature_value;
											}
										}
									}

									$features_count = count( $feature_names );

									for ( $index = 0; $index < $features_count; $index++ ) {
										if ( isset( $property_features[ $index ] ) && isset( $feature_names[ $index ] ) ) {
											if ( $property_features[ $index ] == $feature_names[ $index ] ) {
												?>
                                                <p>
                                                    <span class="compare-icon check"><?php inspiry_safe_include_svg( '/icons/done.svg' ); ?></span>
                                                </p>
												<?php
											} else {
												/**
												 * If feature doesn't match then add a 0 at that
												 * index of property_features array.
												 */
												array_splice( $property_features, $index, 0, array( 0 ) );
												?>
                                                <p>
                                                    <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
                                                </p>
												<?php
											}
										} else {
											?>
                                            <p>
                                                <span class="compare-icon cross"><?php inspiry_safe_include_svg( '/icons/cross.svg' ); ?></span>
                                            </p>
											<?php
										}
									}
								}

								if ( in_array( 'additional-fields', $comparable_fields ) ) {
									do_action( 'ere_compare_additional_property_fields', false, $property_id );
								}
								?>
                            </div><!-- .rh-compare-properties-column -->
							<?php
						}
						?>
                    </div>
                </div>
				<?php
			} else {
				?>
                <p class="nothing-found">
					<?php esc_html_e( 'No property selected to compare!', 'framework' ); ?>
                </p>
				<?php
			}

			// Display page content area at bottom
			do_action( 'realhomes_content_area_at_bottom' );
			?>
        </div>
    </section>
<?php
get_footer();