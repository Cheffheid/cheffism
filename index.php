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
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
								</div><!-- .post-info -->
							</header><!-- .entry-header -->

							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						</article><!-- #post-<?php the_ID(); ?> -->
					<?php endwhile; ?>
				</div>
				<div class="home-blocks">
					<div class="about-me home-block">
					<?php if (qtrans_getLanguage() == 'en') : ?>
						<h3>Who am I?</h3>
						<p>I am a front-end/web developer from the Netherlands that is currently living in the US. 
						I've a peculiar set of interests that will put me in the realm of geekdom.</p>
						<a href="/about/">Read more about me</a>
					<?php else : ?>
						<h3>Wie ben ik?</h3>
						<p>Ik ben een front-end/web developer uit Nederland wie op dit moment in de VS woont.
						Ik heb een ongebruikelijke set interesses die me vrij duidelijk in het domein van "geek" plaatsen.</p>
						<a href="/about/">Lees meer over mij</a>
					<?php endif; ?>
					</div>
					<div class="contact home-block">
						<?php if (qtrans_getLanguage() == 'en') : ?>
							<h3>Want to contact me?</h3>
							<p>The easiest, and fastest, way to reach me is probably <a href="http://twitter.com/cheffheid">Twitter</a>. 
							If you want to say more than a simple "Hi!" and express yourself in more than 140 characters, e-mail me at Jeffrey.deWit at gmail.com.</p>
						<?php else : ?>
							<h3>Wil je me bereiken?</h3>
							<p>De makkelijkste, en snelste, manier is waarschijnlijk via <a href="http://twitter.com/cheffheid">Twitter</a>. 
							Als je meer dan alleen een simpele "Hallo!" wilt zeggen en je meer dan 140 karakters nodig hebt, mail me dan Jeffrey.deWit at gmail.com.</p>
						<?php endif; ?>
					</div>
					<div class="clear"</div>
				</div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>