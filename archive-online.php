<?php

$context = Timber::get_context();
$post = new TimberPost(33);
$context['post'] = $post;

// $latest = array(
// 	'post_type'				=> 'tv',
// 	'posts_per_page' 	=> 1,
// 	'order' 					=> 'ASC',
// 	'has_password'   => FALSE
// );
//
// $context['latest'] = Timber::get_posts($latest);
$context['categories'] = Timber::get_terms('online-categories');

Timber::render( 'archive-video.twig', $context );
