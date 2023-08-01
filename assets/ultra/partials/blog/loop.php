<?php
/**
 * Blog Loop File
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		$post_id = get_the_ID();
		$format  = get_post_format( $post_id );
		if ( false === $format ) {
			$format = 'standard';
		}
		?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-thumbnail-wrapper">
				<?php
				// Image, gallery or video based on format.
				if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ), true ) ) {
					get_template_part( 'assets/ultra/partials/blog/post-formats/' . $format );
				}
				if ( ( ! empty( get_the_post_thumbnail() ) ) || ! empty( get_post_meta( $post_id, 'REAL_HOMES_gallery', true ) ) ) {
					get_template_part( 'assets/ultra/partials/blog/post/post-author' );
				}
				?>
            </div>
            <div class="entry-summary">
                <div class="entry-header">
					<?php
					// Post meta.
					if ( 'true' === get_option( 'realhomes_display_blog_meta', 'true' ) ) {
						get_template_part( 'assets/ultra/partials/blog/post/meta' );
					}

					// Post title.
					get_template_part( 'assets/ultra/partials/blog/post/title' );
					?>
                </div>
				<?php
				if ( strpos( get_the_content(), 'more-link' ) === false ) {
					the_excerpt();
				} else {
					the_content( '' );
				}
				?>
            </div>
        </article>
		<?php
	}

	inspiry_theme_pagination();
} else {
	realhomes_print_no_result();
}