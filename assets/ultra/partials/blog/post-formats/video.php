<?php
/**
 * Video post format.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
if ( is_single() ) {
	$embed_code = get_post_meta( get_the_ID(), 'REAL_HOMES_embed_code', true );
	if ( ! empty( $embed_code ) ) {
		?>
        <div class="post-video ratio ratio-16X9">
            <?php echo stripslashes( wp_specialchars_decode( $embed_code ) ); ?>
        </div>
		<?php
	} else if ( ! empty( get_the_post_thumbnail() ) ) {
		$image_id  = get_post_thumbnail_id();
		$image_url = wp_get_attachment_url( $image_id );
		?>
        <div class="post-video">
            <a href="<?php echo esc_url( $image_url ); ?>" data-fancybox class="" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'post-featured-image' ); ?>
            </a>
        </div>
		<?php
	}
} else if ( ! empty( get_the_post_thumbnail() ) ) {
	?>
    <div class="post-video">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( 'post-featured-image' ); ?>
        </a>
    </div>
	<?php
}