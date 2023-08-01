<?php

if ( ! function_exists( 'rh_partners_meta_boxes' ) ) {

	/**
	 * Contains Partners's meta box declaration
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	function rh_partners_meta_boxes( $meta_boxes ) {

		$show_for_content = array(
			'template' => array(
				'templates/contact.php',
			),
		);

		$meta_boxes[] = array(
			'id'         => 'partners-hide-meta-box',
			'title'      => esc_html__( 'Partners', 'framework' ),
			'post_types' => array( 'page' ),
			'show'       => $show_for_content,
			'context'    => 'normal',
			'priority'   => 'default',
			'fields'     => array(
				array(
					'name'      => esc_html__( 'Hide Partners ?', 'framework' ),
					'id'        => 'REAL_HOMES_hide_partners',
					'type'      => 'switch',
					'style'     => 'square',
					'on_label'  => esc_html__( 'Yes', 'framework' ),
					'off_label' => esc_html__( 'No', 'framework' ),
					'std'       => 0,
					'columns'   => 8,
					'class'     => 'inspiry_switch_inline'
				),
			),
		);

		// Apply a filter before returning meta boxes.
		$meta_boxes = apply_filters( 'realhomes_partners_display_meta', $meta_boxes );

		return $meta_boxes;

	}

	add_filter( 'rwmb_meta_boxes', 'rh_partners_meta_boxes' );

}

