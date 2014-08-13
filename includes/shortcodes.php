<?php
/**
 * Calculate age shortcode, used on about page.
 * Laziness wins!
 */
function cheffism_age_function($atts){
   extract(shortcode_atts(array(
      'date' => '11/04/1985',
      'format' => 'dd/MM/YYYY'
   ), $atts));

  
  //explode the date to get month, day and year
  $date = explode("/", $date);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $date[1], $date[0], $date[2]))) > date("md")
    ? ((date("Y") - $date[2]) - 1)
    : (date("Y") - $date[2]));

  return $age;

}
/**
 * Global shortcode registration
 */
function cheffism_register_shortcodes(){
   add_shortcode('age', 'cheffism_age_function');
}
add_action( 'init', 'cheffism_register_shortcodes');