<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */
?>

<?php /* Show page navigation when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<noscript>
		<nav id="nav-above" role="article">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cheffism' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cheffism' ) ); ?></div>
		</nav><!-- #nav-above -->
	</noscript>
<?php endif; ?>

<?php /* Start the Loop */  ?>
<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
		<header class="entry-header">
			<div class="calendar">
				<p><?php echo get_the_date( 'd' ); ?> <span><?php echo get_the_date( 'M' ); ?></span></p>
			</div>
			<div class="post-info">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'cheffism' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="entry-meta">
					<?php
						printf( __( '<span class="sep">Posted by </span> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', 'cheffism' ),
							get_author_posts_url( get_the_author_meta( 'ID' ) ),
							sprintf( esc_attr__( 'View all posts by %s', 'cheffism' ), get_the_author() ),
							get_the_author()
						);
					?>
					<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'in ', 'cheffism' ); ?></span><?php the_category( ', ' ); ?></span>
				</div><!-- .entry-meta -->
			</div><!-- .post-info -->
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt('...'); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-meta">
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'cheffism' ) . '</span>', ', ', '<span class="meta-sep"> | </span>' ); ?>
			<span class="readmore"><a href="<?php the_permalink();?>">Read more</a></span>
			<?php edit_post_link( __( 'Edit', 'cheffism' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

<?php /* Show page navigation when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-above" role="article">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cheffism' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cheffism' ) ); ?></div>
	</nav><!-- #nav-above -->
<?php endif; ?>
	
</div>

