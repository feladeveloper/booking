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
        <div class="main-content">
	        <?php get_template_part( 'assets/ultra/partials/blog/content' ); ?>
        </div>
    </div><!-- .rh-page-container -->
<?php
get_footer();