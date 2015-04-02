<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="content main-wrap">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(get_post_meta(get_the_ID(), 'article_class', true)); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<header class="entry-header">
						<h1 class="page-title entry-title" itemprop="name"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="alternative"><?php if ( function_exists( 'the_msls' ) ) the_msls(); ?></div>
					<div class="entry-content" itemprop="text">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">

						<div class="entry-meta">
							<?php 
								_e('Posted on', 'cheffism' );
								printf( ' <time class="entry-date" datetime="%1$s" itemprop="datePublished">%2$s</time> ',
									get_the_date( 'c' ),
									get_the_date()
								);
								_e('by', 'cheffism');
							?>
							<time class="updated hidden" 
								itemprop="dateModified" 
								datetime="<?php the_modified_date( 'Y-m-d' ); ?>">
									<?php the_modified_date(); ?>
							</time>
							<span class="author post-author vcard">
								<span class="fn">
									<?php the_author_link(); ?>
								</span>
							</span>
						</div><!-- .entry-meta -->

						<?php
							$tag_list = get_the_tag_list( '', ', ' );
							$category = get_the_category();
							
							if ( $category[0]->name == 'Uncategorized' ) {
								$utility_text = __( 'This post is', 'cheffism' );
								$utility_text .= ' <span itemprop="about">%1$s</span> ';
							} else {
								$utility_text = __( 'It\'s probably about', 'cheffism' );
								$utility_text .= ' <span itemprop="about">%1$s</span> ';
							}

							
							if ( '' != $tag_list ) {
								$utility_text .= __('and also', 'cheffism');
								$utility_text .= ' <span itemprop="keywords">%2$s</span>. ';
							}

							printf(
								$utility_text,
								get_the_category_list( ', ' ),
								$tag_list,
								get_permalink(),
								the_title_attribute( 'echo=0' )
							);
						?>

						<?php edit_post_link( __( 'Edit', 'cheffism' ), '<span class="edit-link">', '</span>' ); ?>

					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
				<?php cheffism_post_footer(); ?>
			<?php endwhile; // end of the loop. ?>
				<nav id="nav-above" role="article">
					<div class="fixed previous"><?php previous_post_link('%link', '&larr; Older Post'); ?></div>
					<div class="fixed next"><?php next_post_link('%link', 'Newer Post &rarr;'); ?></div>
				</nav><!-- #nav-above -->
			</div><!-- #content -->	
		</div><!-- #primary -->

<?php get_footer(); ?>