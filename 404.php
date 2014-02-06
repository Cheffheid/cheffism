<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

	<div id="primary">
		<div id="content">

			<article id="post-0" class="archives post error404 not-found" role="article">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oh dear...', 'cheffism' ); ?></h1>
				</header>

				<div class="entry-content">
						<p>
							<?php _e( "It seems we can't find what you're looking for. Perhaps searching, or one of the links below, can help you get away from this black hole of doom. Unless I fucked something up, in which case you're on your own(And you should let me know :)).", 'cheffism' ); ?>
						</p>
					<section id="search-archives">
						<?php get_search_form(); ?>
					</section>
					
					<section>
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					</section>
					
					<section id="archive-categories" class="clearfix">
						<h2><?php _e('Posts by topic'); ?></h2>
						<ul class="archive-list">
							<?php wp_list_categories('show_count=1&title_li=&hierarchical=0'); ?>
						</ul>
					</section>
					<section id="archive-months" class="clearfix">
						<h2><?php _e('Posts by month'); ?></h2>
						<ul class="archive-list">
							<?php wp_get_archives('show_post_count=true'); ?>
						</ul>
					</section>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>