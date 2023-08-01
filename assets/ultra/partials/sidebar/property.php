<?php
/**
 * Property sidebar
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
if ( is_active_sidebar( 'property-sidebar' ) ) {
	?>
    <aside class="rh-property-sidebar rh-sidebar sidebar">
		<?php dynamic_sidebar( 'property-sidebar' ); ?>
    </aside>
	<?php
}