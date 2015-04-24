<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<section id="primary" role="region">
				<header>
					<h1 class="list-title">
						<span><?php echo single_cat_title( '', false ); ?> Post Archive</span>
					</h1>

				</header>

				<?php get_template_part( 'loop', 'category' ); ?>

		</section><!-- #primary -->

<?php get_footer(); ?>