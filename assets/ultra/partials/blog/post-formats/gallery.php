<?php
/**
 * Gallery post format.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$REAL_HOMES_gallery = get_post_meta( get_the_ID(), 'REAL_HOMES_gallery', true );
if ( ! empty( get_the_post_thumbnail( get_the_ID() ) ) || ! empty( $REAL_HOMES_gallery ) ) {
	?>
    <div class="gallery-post-slider flexslider">
        <ul class="slides">
			<?php
			list_gallery_images();
			?>
        </ul>
    </div>
	<?php
}
?>