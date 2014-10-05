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
						<span>Post Archive</span>
					</h1>

				</header>

				<?php get_template_part( 'loop', 'category' ); ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>