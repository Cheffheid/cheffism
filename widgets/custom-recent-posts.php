<?php
/*
Plugin Name: Cheffism - Recent Posts
Plugin URI: http://cheffism.com
Description: Simple Recent Posts widget
Author: Jeffrey de Wit
Version: 1
Author URI: http://cheffism.com
*/

class CustomRecentPosts extends WP_Widget {
	function CustomRecentPosts() {
		$widget_ops = array('classname' => 'CustomRecentPosts', 'description' => 'Simple Recent Posts widget' );
    	$this->WP_Widget('CustomRecentPosts', 'Recent Posts Slider', $widget_ops);
  	}
 
	function form($instance) {
    	$instance = wp_parse_args( (array) $instance, array( 'amount' => 1 ) );
    	$amount = $instance['amount'];

?>
  	<p>
  		<label for="<?php echo $this->get_field_id('amount'); ?>">
  			Amount of posts: <input class="widefat" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" type="text" value="<?php echo attribute_escape($amount); ?>" />
  		</label>
  	</p>
<?php
  	}
 
	function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['amount'] = $new_instance['amount'];
    	return $instance;
 	}
 
  	function widget($args, $instance) {
    	extract($args, EXTR_SKIP);
 
    	echo $before_widget;
    	$amount = empty($instance['amount']) ? ' ' : $instance['amount'];
      
      $args = array( 'showposts' => $amount );
 		
		  $widget_query = new WP_Query( $args );
		
  		if ( $widget_query->have_posts()) :
        echo '<div class="flexslider">';
  			while ($widget_query->have_posts()) : $widget_query->the_post(); 
  			?>
          <article class="entry">
    				<header>
              <h1><a href="<?php get_permalink() ?>"><?php the_title() ?></a></h1>
            </header>
            <div class="meta"> 
              <div class="calendar">
                <p><?php echo get_the_date( 'd' ); ?> <span><?php echo get_the_date( 'M' ); ?></span></p>
              </div>
            </div>
            <div class="text"><?php the_excerpt(); ?></div>
          </article>
  			<?php
  			endwhile;
        echo "</div>";
  		endif;
  		
  		wp_reset_query();
 
    	echo $after_widget;
  	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("CustomRecentPosts");') );?>