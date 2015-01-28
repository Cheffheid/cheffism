<?php
/**
 * Template Name: Home
 * Description: site index page
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); 

if ( have_posts() ) :
	$first = true;

	// Start the loop.
	while ( have_posts() ) : the_post();
		if ( $first ) {
			get_template_part( 'content-templates/content', 'featured');
			$first = false;
		} else {
			get_template_part( 'content-templates/content', 'link' );
		}
	// End the loop.
	endwhile;
	
// If no content, include the "No posts found" template.
else :
	get_template_part( 'content', 'none' );

endif; 


get_footer(); 

?>
