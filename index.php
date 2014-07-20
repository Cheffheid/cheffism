<?php
/**
 * Template Name: Home
 * Description: site index page
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>
		<div id="content" class="content full-width">
			<div class="main-wrap">
				<div class="intro">
					<h2>Jeffrey de Wit</h2>
					<?php
						dynamic_sidebar( 'homepage-2' );
					?>
				</div>
				<div itemscope itemtype="http://schema.org/Blog">
					<?php
						$args = array(
							'posts_per_page' => 1,
							'cat' => -21,
						);

						$wp_query = new WP_Query( $args );

						while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
						$posttags = get_the_tags(); 
						$category = get_the_category(); 
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(get_post_meta(get_the_ID(), 'article_class', true)); ?> role="article" itemprop="blogPosts" itemscope itemtype="http://schema.org/BlogPosting">
						<header class="entry-header">
							<h2 class="entry-title" itemprop="name">
								<a href="<?php the_permalink(); ?>" 
						title="<?php printf( esc_attr__( 'Permalink to %s', 'cheffism' ), the_title_attribute( 'echo=0' ) ); ?>" 
						rel="bookmark"><?php the_title(); ?></a>
							</h2>
						</header><!-- .entry-header -->

						<div class="entry-summary" itemprop="text">
							<?php the_content(); ?>
						</div><!-- .entry-summary -->
						<footer class="entry-meta">

							<div class="entry-meta">
								<?php 
									_e('Posted on', 'cheffism' );
									printf( ' <a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" itemprop="datePublished">%3$s</time></a> ',
										get_permalink(),
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
										<?php the_author_posts_link(); ?>
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
				<?php endwhile; ?>
				<div class="fixed previous">
					<?php previous_post_link('%link', '&larr; Older Post'); ?>
				</div>

				</div>
			</div>
		</div><!-- #content -->
<?php get_footer(); ?>