<?php
/**
 * Template Name: Home
 * Description: site index page
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<div id="primary">
			<div id="content">
				<div class="home-most-recent">
					<?php
					/* Grab and show the excerpt of the first two posts */
					$top_query = new WP_Query('showposts=1');

					while ( $top_query->have_posts() ) : $top_query->the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
							<header class="entry-header">
								<div class="post-info">
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'cheffism' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
								</div><!-- .post-info -->
							</header><!-- .entry-header -->

							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						</article><!-- #post-<?php the_ID(); ?> -->
					<?php endwhile; ?>
				</div>
				<?php 
					
					$frontpage_id = get_option('page_on_front');
					$frontpage = get_page( $frontpage_id );
					
					$content = $frontpage->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]>', $content);
					echo $content;
				?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>