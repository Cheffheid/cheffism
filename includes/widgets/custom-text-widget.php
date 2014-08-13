<?php
/*
Plugin Name: Cheffism - Recent Posts
Plugin URI: http://cheffism.com
Description: Custom Text Widget
Author: Jeffrey de Wit
Version: 1
Author URI: http://cheffism.com
*/

class CustomTextWidget extends WP_Widget {

  function __construct() {
    $widget_ops = array('classname' => 'widget_custom_text', 'description' => __('Arbitrary text or HTML, Pure grid selection'));
    $control_ops = array('width' => 400, 'height' => 350);
    parent::__construct('custom_text', __('Custom Text'), $widget_ops, $control_ops);
  }

  function widget( $args, $instance ) {
    extract($args);
    $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
    $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
    $grid = $instance['text_grid'];
    echo '<div class="' . $grid . '">';
    echo $before_widget;
    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
      <div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
    <?php
    echo $after_widget;
    echo '</div>';
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    if ( current_user_can('unfiltered_html') )
      $instance['text'] =  $new_instance['text'];
    else
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
    $instance['filter'] = isset($new_instance['filter']);

    $instance['text_grid'] = $new_instance['text_grid'];
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'text_grid' => '' ) );
    $title = strip_tags($instance['title']);
    $text = esc_textarea($instance['text']);
    $grid = $instance['text_grid'];

    $grid_options = array(
      'pure-u-1',
      'pure-u-1-2',
      'pure-u-1-3',
      'pure-u-2-3',
      'pure-u-1-4',
      'pure-u-3-4',
      'pure-u-1-5',
      'pure-u-2-5',
      'pure-u-3-5',
      'pure-u-4-5',
      'pure-u-1-6',
      'pure-u-5-6',
      'pure-u-1-8',
      'pure-u-3-8',
      'pure-u-5-8',
      'pure-u-7-8',
      'pure-u-1-12',
      'pure-u-5-12',
      'pure-u-7-12',
      'pure-u-11-12',
      'pure-u-1-24',
      'pure-u-5-24',
      'pure-u-7-24',
      'pure-u-11-24',
      'pure-u-13-24',
      'pure-u-17-24',
      'pure-u-19-24',
      'pure-u-23-24'
    );
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id('text_grid'); ?>"><?php _e('What grid size should this widget be?'); ?></label>
    <select name="<?php echo $this->get_field_name('text_grid'); ?>" id="<?php echo $this->get_field_id('text_grid'); ?>">
    <?php
        for ( $i = 0; $i < 28; ++$i )
          echo "<option value='$grid_options[$i]' " . selected( $grid, $grid_options[$i], false ) . ">$grid_options[$i]</option>";
    ?>
    </select></p>

    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

    <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
<?php
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("CustomTextWidget");') );?>