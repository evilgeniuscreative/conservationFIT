<?php
/**
 * Plugin Name: SWW Tile
 * Plugin URI: 
 * Description: Implement shortcode to style image+text as a tile
 * Version: 1.0
 * Author: Charles Hall
 */

 add_action( 'init', 'register_tiles_shortcode');

 function register_tiles_shortcode(){
   add_shortcode('sww_tile', 'show_tile_function');
 }

 function show_tile_function($atts,$content = null) {
    extract(shortcode_atts(array(
      'height' => 100,
      'width'  => 100,
      'align'  => 'left',
      'margin' => '2px',
      'padding'=> '2px',
      'bgcolor'=> 'white',
    ), $atts));

    $s = "<div style=\"height: $height" . "px; width: $width" .
      "px; text-align: center; float: left; " .
      "border: 1px solid gray; " .
      "text-align: $align; " .
      "margin: $margin; padding: $padding;background-color: $bgcolor;" .
     "\" >";
    return $s . $content . "</div>\n";
 }

