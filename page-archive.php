<?php
/**
 * Template Name: Archives
 * Description: Archive page
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<div id="primary" class="main-wrap">
			<div class="material-block text-center">
				<h2 class="sr-only"><?php _e('Search', 'cheffism'); ?></h2>
				<?php get_search_form(); ?>
			</div>
			<div id="content" class="archives page-wrap material-block">

				<article>
					<section id="archive-categories" class="clearfix">
						<h2><?php _e('Posts by topic', 'cheffism'); ?></h2>
						<ul class="archive-list">
							<?php wp_list_categories('show_count=1&title_li=&hierarchical=0'); ?>
						</ul>
					</section>
					<section id="archive-months" class="clearfix">
						<h2><?php _e('Posts by month', 'cheffism'); ?></h2>
						<ul class="archive-list">
							<?php wp_get_archives('show_post_count=true'); ?>
						</ul>
					</section>
				</article>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>