<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */
?>

<?php
	$args = array(
		'posts_per_page' => 1,
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
	<footer class="post-meta">
		<time 
			itemprop="datePublished" 
			datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
				Published: <?php echo get_the_date( 'd F Y' ); ?>
		</time>
		<time class="updated hidden" 
			itemprop="dateModified" 
			datetime="<?php the_modified_date( 'Y-m-d' ); ?>">
				<?php the_modified_date(); ?>
		</time>
		<span class="cat-links inline <?php echo $category[0]->slug; ?>">
			<?php
				$categories = get_the_category();
				$output = '';
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'
								.get_category_link( $category->term_id )
								.'" title="' 
								. esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) 
								. '">#'.$category->cat_name
								.'</a>';
					}
					echo trim($output, $separator);
				}
			?>
		</span>
		<?php if ($posttags) : ?>
				<span class="tag-links inline">
				<?php _e('Keywords', 'cheffism'); ?>:
				<ul itemprop="keywords">
			        <?php
	  					foreach($posttags as $tag) {
	  						$tagMarkup = '<li><a href="%1$s" title="More posts tagged %2$s">%2$s</a></li>';

	  						printf($tagMarkup, get_tag_link($tag->id), $tag->name);
	  					}
					?>
				</ul>
			</span>
		<?php endif; ?>
		<span class="author post-author vcard hidden">
			<span class="fn">
				<?php the_author_posts_link(); ?>
			</span>
		</span>
	</footer><!-- .post-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; ?>

<?php previous_post_link('%link', 'Older Post'); ?>

