<?php
/**
 * Field: Agency Locations
 *
 * Agency Locations field for agency search form.
 *
 * @since    4.0.0
 * @package  realhomes/modern
 */
$locations_placeholder_text = get_option( 'realhomes_agency_locations_placeholder', 'Locations' );
if ( empty( $locations_placeholder_text ) ) {
	$locations_placeholder_text = esc_html__( 'Locations', 'framework' );
}
?>
<div class="rh_agency_search__option inspiry_bs_default_mod inspiry_bs_agents_listing inspiry_bs_green">
    <span class="rh_agency_search__selectwrap">
		<select name="agency-locations" id="agency-locations" class="rh_agency_search__locations inspiry_select_picker_trigger inspiry_select_picker_agency inspiry_select_picker_status show-tick" data-size="5">
            <option value=""><?php echo esc_html( $locations_placeholder_text ); ?></option>
            <?php realhomes_agency_locations_options(); ?>
		</select>
	</span>
</div>