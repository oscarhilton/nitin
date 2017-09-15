<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

// $context['thumb'] = getVideoThumb();

Timber::render( 'single-video.twig', $context );
