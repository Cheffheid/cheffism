<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */
?>

<?php /* Start the Loop */  ?>
<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php 
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

			<div class="entry-summary" itemprop="description">
				<?php the_excerpt(); ?>
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
						<link rel="author" href="https://plus.google.com/u/0/+JeffreydeWitCheff"/>
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

					$utility_text .= '<div><a class="read-more" href="%3$s" title="Read %4$s">Read This Article</a></div>';

					printf(
						$utility_text,
						get_the_category_list( ', ' ),
						$tag_list,
						get_permalink(),
						the_title_attribute( 'echo=0' )
					);
				?>
			</footer><!-- .entry-meta -->
		</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

	<?php /* Show page navigation when applicable */ ?>
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-above" role="article" class="material-block cf fixed-post-nav">
			<div class="fixed previous"><?php next_posts_link( __( '&larr; Older posts', 'cheffism' ) ); ?></div>
			<div class="fixed next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'cheffism' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif; ?>
<?php else: ?>
	<p class="no-results">No posts here. Check back later!</p>
<?php endif; ?>


