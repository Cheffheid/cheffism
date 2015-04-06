<?php
/**
 * Template Name: Home
 * Description: site index page
 * @package WordPress
 * @subpackage Cheffism
 */
get_header(); ?>

<div id="content" class="content full-width">
	<div class="main-wrap" role="main">
		<div class="intro">
			<?php
				dynamic_sidebar( 'homepage-content' );
			?>
		</div>
		<div>
			<?php
				$args = array( 'posts_per_page' => 1,
					'ignore_sticky_posts' => true );
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) : $query->the_post();
					
					get_template_part( 'postformats/post', get_post_format() );
					
					endwhile;
					echo '<div class="fixed previous">';
					previous_post_link('%link', '&larr; Older Post');
					echo '</div>';
				} else {
					get_template_part( 'postformats/post', 'none' );
				}
			?>
		</div>
		<?php cheffism_home_footer(); ?>
	</div>
</div><!-- #content -->

<?php get_footer(); ?>