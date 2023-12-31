<?php
/**
 * Field: Property ID
 *
 * @since    3.0.0
 * @package realhomes/dashboard
 */

$property_id_value   = '';
$auto_property_id    = get_option( 'inspiry_auto_property_id_check' );
$property_id_pattern = get_option( 'inspiry_auto_property_id_pattern' );
$property_id_label   = get_option( 'realhomes_submit_property_id_label' );
$is_disabled         = ( 'true' === $auto_property_id && ! empty( $property_id_pattern ) );

if ( empty( $property_id_label ) ) {
	$property_id_label = esc_html__( 'Property ID', 'framework' );
}

if ( $is_disabled ) {
	$property_id_value = $property_id_pattern;
}

if ( realhomes_dashboard_edit_property() ) {
	global $post_meta_data;
	if ( isset( $post_meta_data['REAL_HOMES_property_id'] ) ) {
		$property_id_value = $post_meta_data['REAL_HOMES_property_id'][0];
	}
}
?>
<p>
    <label for="property-id"><?php echo esc_html( $property_id_label ); ?></label>
    <span class="property-id-field-wrapper<?php
	if ( $is_disabled ) {
		echo esc_attr( ' disabled-field' );
	}
	?>">
        <input id="property-id" name="property-id" type="text" value="<?php echo esc_attr( $property_id_value ); ?>"<?php disabled( true, $is_disabled ); ?> />
        <?php if ( $is_disabled ) : ?>
            <i class="fas fa-lock"></i>
        <?php endif; ?>
    </span>
</p>