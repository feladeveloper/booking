<?php
/**
 * Gallery 4 Columns Template
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

global $gallery_columns, $gallery_properties;
$gallery_columns    = 'properties-gallery-4-columns';
$gallery_properties = 20;

get_header();

get_template_part( 'assets/ultra/partials/properties/gallery' );

get_footer();