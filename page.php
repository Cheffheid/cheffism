<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>
	<div id="content" class="content main-wrap">
		<?php the_post(); ?>

		<article class="page-wrap post" id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
			<header class="entry-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cheffism' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'cheffism' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div><!-- #content -->

<?php get_footer(); ?>