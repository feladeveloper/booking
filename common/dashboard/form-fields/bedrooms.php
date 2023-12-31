<?php
/**
 * Field: Bedrooms
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */

$property_bedrooms_label = get_option( 'realhomes_submit_property_bedroom_label' );
if ( empty( $property_bedrooms_label ) ) {
	$property_bedrooms_label = esc_html__( 'Bedrooms', 'framework' );
}
?>
<p>
	<label for="bedrooms"><?php echo esc_html( $property_bedrooms_label ); ?></label>
	<input id="bedrooms" name="bedrooms" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_bedrooms'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_bedrooms'][0] );
	    }
	}
	?>" title="<?php esc_attr_e( '* Please provide the value in digits only!', 'framework' ); ?>"/>
</p>