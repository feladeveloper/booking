<?php
/**
 * Field: Property Status
 *
 * @since    3.0.0
 * @package realhomes/dashboard
 */
$property_status_label = get_option( 'realhomes_submit_property_status_label' );
if ( empty( $property_status_label ) ) {
	$property_status_label = esc_html__( 'Status', 'framework' );
}
?>
<p>
    <label for="status"><?php echo esc_html( $property_status_label ); ?></label>
    <select name="status" id="status" class="inspiry_select_picker_trigger show-tick">
		<?php
		if ( realhomes_dashboard_edit_property() ) {
			global $target_property;
			realhomes_edit_form_hierarchical_options( $target_property->ID, 'property-status' );
		} else {
			?>
            <option selected="selected" value="-1"><?php esc_html_e( 'None', 'framework' ); ?></option><?php
			if ( class_exists( 'ERE_Data' ) ) {
				realhomes_id_based_hierarchical_options( ERE_Data::get_hierarchical_property_statuses(), - 1 );
			}
		}
		?>
    </select>
</p>