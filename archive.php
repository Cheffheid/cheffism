<?php
/**
 * Template Name: Archives
 * Description: Archive page
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="archives">

				<article>
					<header class="page-header">
						<?php if (qtrans_getLanguage() == 'en') : ?>
							<h1 class="page-title">Archives</h1>
						<?php else : ?>
							<h1 class="page-title">Archieven</h1>
						<?php endif; ?>
						
					</header>
					
					<?php if( is_month() ) : ?>
					
						<?php get_template_part( 'loop', 'archives' ); ?>
					
					<?php else : ?>

					<section id="archive-months" class="clearfix">
						<?php if (qtrans_getLanguage() == 'en') : ?>
							<h2>Browse monthly</h2>
							<p>Browse through my stuff by month.</p>
						<?php else : ?>
							<h2>Per maand bladeren</h2>
							<p>Bekijk m'n spul per maand.</p>
						<?php endif; ?>
						<ul>
							<?php wp_get_archives('show_post_count=true'); ?>
						</ul>
					</section>
					<section id="archive-categories" class="clearfix">
						<?php if (qtrans_getLanguage() == 'en') : ?>
							<h2>Browse categories</h2>
							<p>Or, browse through the categories if you prefer that.</p>
						<?php else : ?>
							<h2>Per onderwerp bladeren</h2>
							<p>Of, blader door de onderwerpen als je dat liever doet.</p>
						<?php endif; ?>
						<ul>
							<?php wp_list_categories('show_count=1&title_li='); ?>
						</ul>
					</section>
					<section id="search-archives">
						<?php if (qtrans_getLanguage() == 'en') : ?>
							<h2>Search for stuff</h2>
							<p>Or, just search for things with a keyword or two.</p>
						<?php else : ?>
							<h2>Zoeken naar dingen</h2>
							<p>Of, zoek naar artikelen met een zoekwoord of twee.</p>
						<?php endif; ?>
							<?php get_search_form(); ?>
					</section>
				</article>

				<?php endif; ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>