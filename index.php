<?php

/*
  Plugin Name: My React Block Plugin
  Version: 1.0
  Author: Grzeganek
  Author URI: https://github.com/LearnWebCode
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function blockregister() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'blockregister' );