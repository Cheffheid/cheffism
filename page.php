<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>
	<div id="content" class="content main-wrap">
		<?php the_post(); ?>

		<article class="hentry page-wrap post" id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
			<header class="entry-header">
				<h1 class="page-title entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cheffism' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'cheffism' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-content -->
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
		</article><!-- #post-<?php the_ID(); ?> -->
	</div><!-- #content -->

<?php get_footer(); ?>