<?php

function targetdna_regenexx_outcome_shortcode( $atts ){
  $a = shortcode_atts( array(
      'mode' => 'light',
    ), $atts );

  extract($a);

  $area = strtoupper($area);
  $type = strtoupper($type);

  $version = date("d.m.y");

  $output = '<script type="text/javascript" src="https://targetdna.com/wp-content/targetdna-assets/outcomes/js/targetdna-outcomes-dist.js?layout=app&v=' . $version . '" class="rx-outcomes-app-script"></script>';

  return $output;
}

add_shortcode('regenexx_outcomes', 'targetdna_regenexx_outcome_shortcode');

