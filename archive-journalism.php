<?php

$context = Timber::get_context();
$post = new TimberPost(72);
$context['post'] = $post;

// $latest = array(
// 	'post_type'				=> 'tv',
// 	'posts_per_page' 	=> 1,
// 	'order' 					=> 'ASC',
// 	'has_password'   => FALSE
// );
//
// $context['latest'] = Timber::get_posts($latest);
// $context['categories'] = Timber::get_terms('tv-categories');

Timber::render( 'archive-video.twig', $context );
