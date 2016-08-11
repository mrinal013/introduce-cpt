<?php
/**
* Plugin Name: Introduce CPT Plugin
* Plugin Name: Introduce Plugin
* Plugin URI: https://github.com/mrinal013/introduce-cpt/
* Author: mrinal013
* Author URI: https://github.com/mrinal013
* Description: This is required plugin for Introduce Theme
* Version: 1.0.1
*
*/


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
            'view_item'             => 'View ' . strtolower( $arg['plural'] ),
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
                //'taxonomies' => $arg['taxonomies'],

            )
        );

        $counter++;
    }
}

add_action( 'init', 'introduce_section_post_types' );


require 'plugin-update-checker/plugin-update-checker.php';
$className = PucFactory::getLatestClassVersion('PucGitHubChecker');
$myUpdateChecker = new $className(
    'https://github.com/mrinal013/introduce-cpt/',
    __FILE__,
    'master'
);
