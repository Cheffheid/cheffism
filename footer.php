<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */
?>
        </main>
        <footer class="">
            <div class="wrap social-menu">
            <?php
                $social = array(
                    'theme_location' => 'footer',
                    'container' => ''
                )
            ?>
            Find me on <?php wp_nav_menu( $social ) ?>
            </div>
            <?php wp_footer(); ?>
        </footer>
        <div class="modal-bg"></div>
    </body>
</html>