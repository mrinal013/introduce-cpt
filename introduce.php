<?php
/**
* Plugin Name: Introduce Custom Post Types & Metaboxes
* Plugin URI: https://github.com/mrinal013/introduce-cpt/
* Author: mrinal013
* Author URI: https://github.com/mrinal013
* Description: This is required plugin for Introduce theme
* Version: 1.0.0
* License: GPLv3
* Text Domain: introduce-cpt
*/

defined ('ABSPATH') or die("Direct Access is not allowed");
//create section post type
function introduce_section_post_types() {
    $types = array(
        'section' => array(
            'menu_title'    => 'Section',
            'plural'        => 'Sections',
            'singular'      => 'Section',
            'supports'      => array( 'title' ),
            'slug'          => 'section',

        ),
        'service' => array(
            'menu_title'    => 'Service',
            'plural'        => 'Services',
            'singular'      => 'Service',
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'slug'          => 'service',
        ),
        'portfolio' => array(
            'menu_title'    => 'Portfolio',
            'plural'        => 'Portfolioes',
            'singular'      => 'Portfolio',
            'supports'      => array( 'title', 'editor', 'thumbnail', 'tags' ),
            'slug'          => 'portfolio',
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'slug'          => 'portfolio',
        ),
    );
    $counter = 0;
    foreach( $types as $type => $arg ) {

        $labels = array(
            'name'                  => $arg['menu_title'],
            'singular_name'         => $arg['singular'],
            'add_new'               => 'Add new ' . $arg['singular'],
            'add_new_item'          => 'Add new ' . strtolower( $arg['singular'] ),
            'edit_item'             => 'Edit ' . strtolower( $arg['singular'] ),
            'new_item'              => 'New ' . strtolower( $arg['singular'] ),
            'all_items'             => 'All ' . strtolower( $arg['plural'] ),
            'view_item'             => 'View ' . strtolower( $arg['menu_title'] ),
            'search_items'          => 'Search ' . strtolower( $arg['plural'] ),
            'not_found'             => 'No ' . strtolower( $arg['plural'] ) . ' found',
            'not_found_in_trash'    => 'No ' . strtolower( $arg['plural'] ) . ' found in Trash',
            'parent_item_colon'     => '',
            'menu_name'             => $arg['menu_title'],
        );

        register_post_type( $type,
            array(
                'labels'            => $labels,
                'public'            => true,
                'has_archive'       => true,
                'capability_type'   => 'post',
                'supports'          => $arg['supports'],
                'rewrite'           => array( 'slug' => $arg['slug'] ),
                'menu_position'     => ( 20 + $counter ),
            )
        );

        $counter++;
    }
}

add_action( 'init', 'introduce_section_post_types' );

/*
* Register a tag box in portfolio cpt
*/
add_action( 'init', 'create_book_tax' );

function create_book_tax() {
	register_taxonomy(
		'portfoio_type',
		'portfolio',
		array(
			'label' => __( 'Type', 'introduce-cpt' ),
			'rewrite' => array( 'slug' => 'portfoio_type' ),
			'hierarchical' => false,
            'update_count_callback' => '_update_post_term_count',
		)
	);
}

add_action( 'admin_print_scripts-post-new.php', 'section_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'section_admin_script', 11 );

function section_admin_script() {
    global $post_type;
    if( 'section' == $post_type )
    wp_enqueue_script( 'section_admin_script', plugins_url('/js/section.js', __FILE__ ), array('jquery'), '', true );
}

add_action('admin_head', 'wpds_custom_admin_post_css');
function wpds_custom_admin_post_css() {

    global $post_type;

    if ($post_type == 'section') {
        echo "<style>#edit-slug-box {display:none;}</style>";
    } else if ($post_type == 'service') {
        echo "<style>#edit-slug-box {display:none;}</style>";
    } else if ($post_type == 'portfolio') {
        echo "<style>#edit-slug-box {display:none;}</style>";
    }
}

/**
* Codestar framework include
*/
require ( plugin_dir_path( __FILE__ ) . "/codestar/cs-framework.php" );

/*
* metaboxes for introduce theme
*/
require ( plugin_dir_path( __FILE__ ) . "/metaboxes/metaboxes.php" );


require 'plugin-update-checker/plugin-update-checker.php';
$className = PucFactory::getLatestClassVersion('PucGitHubChecker');
$myUpdateChecker = new $className(
    'https://github.com/mrinal013/introduce-cpt/',
    __FILE__,
    'master'
);
