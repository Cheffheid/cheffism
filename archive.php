<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

get_header(); ?>

		<div id="primary" role="region">

				<header>
					<h1 class="list-title">
						<span><?php post_type_archive_title(); single_cat_title(); single_month_title(); ?></span>
					</h1>

				</header>

				<?php get_template_part( 'loop', 'category' ); ?>

		</div><!-- #primary -->

<?php get_footer(); ?>