<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

	<div id="primary">
		<div id="content">

			<article id="post-0" class="post error404 not-found" role="article">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oh dear...', 'themename' ); ?></h1>
				</header>

				<div class="entry-content">
					<?php if (qtrans_getLanguage() == 'en') : ?>
						<p>It seems we can&rsquo;t find what you&rsquo;re looking for. 
						Perhaps searching, or one of the links below, can help you get away from this black hole of doom. 
						Unless I fucked something up, in which case you're on your own(And you should let me know :)).</p>
					<?php else : ?>
						<p>Het ziet er naar uit dat we niet kunnen vinden wat je zoekt.
						Wellicht dat zoeken, of een van de links hieronder, je kunnen helpen om uit dit zwarte gat van de ondergang te komen.
						Tenzij ik iets stuk heb gemaakt, dan sta je er alleen voor(En je zou me dit moeten laten weten :))</p>
					<?php endif; ?>

					<div id="archive-search">
						<?php get_search_form(); ?>
					</div>
					
					<section>
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					</section>
					
					<section id="archive-months">
						<?php the_widget( 'WP_Widget_Archives', 'show_post_count=true', "after_title=</h2>" ); ?>
						<div class="clear"></div>
					</section>

					<section id="archive-categories">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'themename' ); ?></h2>
						<ul>
							<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 'TRUE', 'title_li' => '', 'number' => '10' ) ); ?>
						</ul>
						<div class="clear"></div>
					</section>
					
					<section id="archive-tags">
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</section>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>