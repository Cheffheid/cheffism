<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */
?>

	</div><!-- #main  -->

	<footer id="colophon" role="contentinfo">
			<div id="site-generator" class="footer-blocks">
				<div class="footer-block">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => '' ) ); ?>
				</div>
				<div class="footer-block right">
					<small>&copy <?php echo date('Y') . " " . esc_attr( get_bloginfo( 'name', 'display' ) ); ?> <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'cheffism' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s.', 'cheffism' ), 'WordPress' ); ?></a></small>
				</div>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>