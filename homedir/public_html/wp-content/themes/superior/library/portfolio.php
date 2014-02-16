<?php


// portfolio

add_action( 'init', 'register_cpt_portfolio' );

function register_cpt_portfolio() {

$labels = array(
'name' => _x( 'Portfolio', 'portfolio' ),
'singular_name' => _x( 'Portfolio', 'portfolio' ),
'add_new' => _x( 'Add New', 'portfolio' ),
'add_new_item' => _x( 'Add New Entry', 'portfolio' ),
'edit_item' => _x( 'Edit Portfolio Entry', 'portfolio' ),
'new_item' => _x( 'New Portfolio Entry', 'portfolio' ),
'view_item' => _x( 'View Portfolio', 'portfolio' ),
'search_items' => _x( 'Search Portfolio Entries', 'portfolio' ),
'not_found' => _x( 'No entries found', 'portfolio' ),
'not_found_in_trash' => _x( 'No entries found in Trash', 'portfolio' ),
'parent_item_colon' => _x( 'Parent Portfolio:', 'portfolio' ),
'menu_name' => _x( 'Portfolio', 'portfolio' ),
);

$args = array(
'labels' => $labels,
'hierarchical' => false,
'description' => 'Portfolio post type generated for studionashvegas.',
'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ),

'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'menu_position' => 5,

'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'rewrite' => true,
'capability_type' => 'post'
);

register_post_type( 'portfolio', $args );
}

// portfolio Taxonomies

add_action( 'init', 'register_taxonomy_Categories' );

function register_taxonomy_Categories() {

$labels = array(
'name' => _x( 'Categories', 'Categories' ),
'singular_name' => _x( 'Categories', 'Categories' ),
'search_items' => _x( 'Search Categories', 'Categories' ),
'popular_items' => _x( 'PopularCategories', 'Categories' ),
'all_items' => _x( 'All Categories', 'Categories' ),
'parent_item' => _x( 'Parent Categories', 'Categories' ),
'parent_item_colon' => _x( 'Parent Categories:', 'Categories' ),
'edit_item' => _x( 'Edit Categories', 'Categories' ),
'update_item' => _x( 'Update Categories', 'Categories' ),
'add_new_item' => _x( 'Add New Categories', 'Categories' ),
'new_item_name' => _x( 'New Categories Name', 'Categories' ),
'separate_items_with_commas' => _x( 'Separate Categories with commas', 'Categories' ),
'add_or_remove_items' => _x( 'Add or remove Categories', 'Categories' ),
'choose_from_most_used' => _x( 'Choose from the most used Categories', 'Categories' ),
'menu_name' => _x( 'Categories', 'Categories' ),
);

$args = array(
'labels' => $labels,
'public' => true,
'show_in_nav_menus' => true,
'show_ui' => true,
'show_skillscloud' => true,
'hierarchical' => true,

'rewrite' => true,
'query_var' => true
);

register_taxonomy( 'Categories', array('portfolio'), $args );
}

add_action( 'init', 'register_taxonomy_skills' );

function register_taxonomy_skills() {

$labels = array(
'name' => _x( 'skills', 'skills' ),
'singular_name' => _x( 'skills', 'skills' ),
'search_items' => _x( 'Search skills', 'skills' ),
'popular_items' => _x( 'Popular skills', 'skills' ),
'all_items' => _x( 'All skills', 'skills' ),
'parent_item' => _x( 'Parent skills', 'skills' ),
'parent_item_colon' => _x( 'Parent skills:', 'skills' ),
'edit_item' => _x( 'Edit skills', 'skills' ),
'update_item' => _x( 'Update skills', 'skills' ),
'add_new_item' => _x( 'Add New skills', 'skills' ),
'new_item_name' => _x( 'New skills Name', 'skills' ),
'separate_items_with_commas' => _x( 'Separate skills with commas', 'skills' ),
'add_or_remove_items' => _x( 'Add or remove skills', 'skills' ),
'choose_from_most_used' => _x( 'Choose from the most used skills', 'skills' ),
'menu_name' => _x( 'skills', 'skills' ),
);

$args = array(
'labels' => $labels,
'public' => true,
'show_in_nav_menus' => true,
'show_ui' => true,
'show_skillscloud' => true,
'hierarchical' => false,

'rewrite' => true,
'query_var' => true
);

register_taxonomy( 'skills', array('portfolio'), $args );
}
