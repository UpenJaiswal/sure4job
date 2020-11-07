<?php

function workup_child_enqueue_styles() {
	wp_enqueue_style( 'workup-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'workup_child_enqueue_styles', 100 );