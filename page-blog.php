<?php
/**
 * Template Name: Blog
 * Description: A blog page
 *
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>
	<div itemscope itemtype="http://schema.org/Blog">
		<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$args = array(
			'posts_per_page' => 5,
			'paged' => $paged
		);

		$wp_query = new WP_Query( $args );
		
		get_template_part( 'loop', 'blog' ); 
		
		?>

	</div><!-- #content -->

<?php get_footer(); ?>