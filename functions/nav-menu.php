<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
add_filter( 'nav_menu_link_attributes', 'tdm_contact_menu_atts', 10, 3 );
function tdm_contact_menu_atts( $atts, $item, $args )
{
  if (in_array("tdm-wmc-off-canvass-overlay", $item->classes)) {
    $atts['data-toggle'] = 'off-canvas-right';
  }
  return $atts;
}
