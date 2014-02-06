<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<section id="primary" role="region">
			<div id="content" class="page-wrap">

				<header>
					<h1 class="list-title">
						<span><?php echo single_cat_title( '', false ); ?></span>
					</h1>
					<?php
						$categorydesc = category_description(); if ( ! empty( $categorydesc ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); 
					?>
				</header>

				<?php get_template_part( 'loop', 'category' ); ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>