<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});

	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'loadScripts' ) );
		if( function_exists('acf_add_options_page') ) {
			acf_add_options_page();
		}
		parent::__construct();
	}

	function register_post_types() {
		$labels = array(
			'name'               => _x( 'TV', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'TV', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'TV', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'TV', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add TV', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New TV', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New TV', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit TV', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View TV', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All TV', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search TV', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent TV:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No TV found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No TV found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon' 				 => 'dashicons-video-alt',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'tv' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		);
		register_post_type( 'tv', $args );
		$labels = array(
			'name'               => _x( 'Online', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Online', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Online', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Online', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add Online', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Online', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Online', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Online', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Online', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Online', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Online', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Online:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No Online found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No Online found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon' 				 => 'dashicons-video-alt',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'online' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		);
		register_post_type( 'online', $args );
		$labels = array(
			'name'               => _x( 'Journalism', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Journalism', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Journalism', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Journalism', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add Journalism', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Journalism', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Journalism', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Journalism', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Journalism', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Journalism', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Journalism', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Journalism:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No Journalism found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No Journalism found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon' 				 => 'dashicons-video-alt',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'journalism' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		);
		register_post_type( 'journalism', $args );
	}

	function register_taxonomies() {
		register_taxonomy(
        'tv-categories',
        array('tv'),
        array(
            'labels' => array(
                'name' => 'Categoies',
                'add_new_item' => 'Add New Categoies',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
		register_taxonomy(
        'journalism-categories',
        array('journalism'),
        array(
            'labels' => array(
                'name' => 'Categoies',
                'add_new_item' => 'Add New Categoies',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
		register_taxonomy(
        'online-categories',
        array('online'),
        array(
            'labels' => array(
                'name' => 'Categoies',
                'add_new_item' => 'Add New Categoies',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
	}

	function loadScripts() {
				wp_enqueue_script('jquery');
				wp_register_script( 'site', get_template_directory_uri() . '/static/site.js', array(), '1.0.0', true );
				wp_enqueue_script( 'site');
				wp_register_script( 'fullPage', get_template_directory_uri() . '/static/jquery.fullpage.min.js', array(), '1.0.0', true );
				wp_enqueue_script( 'fullPage');
	}

	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		return $twig;
	}

	function getVideoThumb() {
		$videoURL = get_field('video_embed_link', false, false);
		$videoID = substr(parse_url($videoURL, PHP_URL_PATH), 1);
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoID.php"));
		$thumb = $hash[0]['thumbnail_large'];
		return $thumb;
	}

}

new StarterSite();
