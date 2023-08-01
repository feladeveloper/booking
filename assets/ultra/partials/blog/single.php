<?php
/**
 * Single Blog Post
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
get_header();

?>
    <div class="rh-page-container container">
        <div class="row">
            <div class="col-8 main-content">
				<?php get_template_part( 'assets/ultra/partials/blog/content' ); ?>
            </div>
			<?php
			if ( is_active_sidebar( 'default-sidebar' ) ) {
				?>
                <div class="col-4 sidebar-content">
					<?php get_sidebar( 'default-sidebar' ); ?>
                </div>
				<?php
			}
			?>
        </div>
    </div><!-- .rh-page-container -->
<?php
get_footer();