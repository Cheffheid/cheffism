<?php
/**
 * Template Name: Blog
 * Description: blog index page
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<div id="primary">
			<div id="content">
				<?php get_template_part( 'loop', 'index' ); ?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>