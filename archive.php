<?php
/**
 * Template Name: Archives
 * Description: Archive page
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<div id="primary" class="main-wrap">
			<div id="content" class="archives page-wrap post">

				<article>
					<?php if( is_month() || is_year() ) : ?>
					
						<?php get_template_part( 'loop', 'archives' ); ?>
					
					<?php else : ?>
					<section id="search-archives">
						<?php get_search_form(); ?>
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
				</article>

				<?php endif; ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>