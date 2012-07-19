<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */
?>

<?php /* Start the Loop */ 
/* Grab and show the excerpt of the first two posts */

$top_query = new WP_Query('showposts=2');

while ( $top_query->have_posts() ) : $top_query->the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
		<header class="entry-header">
			<div class="calendar">
				<p><?php echo get_the_date( 'd' ); ?> <span><?php echo get_the_date( 'M' ); ?></span></p>
			</div>
			<div class="post-info">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<div class="entry-meta">
					<?php
						printf( __( '<span class="sep">Posted by </span> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', 'themename' ),
							get_author_posts_url( get_the_author_meta( 'ID' ) ),
							sprintf( esc_attr__( 'View all posts by %s', 'themename' ), get_the_author() ),
							get_the_author()
						);
					?>
					<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'in ', 'themename' ); ?></span><?php the_category( ', ' ); ?></span>
				</div><!-- .entry-meta -->
			</div><!-- .post-info -->
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt('...'); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-meta">
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'themename' ) . '</span>', ', ', '<span class="meta-sep"> | </span>' ); ?>
			<span class="readmore"><a href="<?php the_permalink();?>">Read more</a></span>
			<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

<div class="recent_posts">
	<h2 class="title"><?php _e('<!--:en-->Other "recent" posts<!--:--><!--:nl-->Andere "recente" posts<!--:-->');?></h3>
<?php
/* Now grab three more and drop them in a list */
$list_query = new WP_Query('showposts=3&offset=2');

while ( $list_query->have_posts() ) : $list_query->the_post(); 


	echo '<div class="recent_post"><div class="recent_posts_date">' . get_the_date() . '</div><div class="recent_posts_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div><div class="clear"></div></div>';
	comments_template( '', true );

endwhile; ?>
	
</div>

