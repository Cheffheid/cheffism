<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<section id="primary" role="region">
			<div id="content" class="page-wrap">

				<?php the_post(); ?>

				<header>
					<h1 class="page-title author"><?php printf( __( 'Posts by <span class="vcard">%s</span>', 'cheffism' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>
				</header>

				<?php rewind_posts(); ?>

				<?php get_template_part( 'loop', 'author' ); ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>