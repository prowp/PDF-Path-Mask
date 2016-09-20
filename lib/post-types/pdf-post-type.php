<?php

/* Add PDF Post Type */

add_action('init', 'masked_pdf_post_type');

function masked_pdf_post_type() {
	$single_name = 'PDF';
	$plural_name = 'PDFs';
	
	
    $labels = array(
        'name' => _x($single_name, 'post type general name', 'masked-pdf'),
        'singular_name' => _x($single_name, 'post type singular name', 'masked-pdf'),
        'add_new' => _x('Add New', $single_name, 'masked-pdf'),
        'add_new_item' => __('Add New '. $single_name, 'masked-pdf'),
        'edit_item' => __('Edit '.$single_name, 'masked-pdf'),
        'new_item' => __('New '.$single_name, 'masked-pdf'),
        'all_items' => __('All '.$plural_name, 'masked-pdf'),
        'view_item' => __('View '.$single_name, 'masked-pdf'),
        'search_items' => __('Search '.$plural_name, 'masked-pdf'),
        'not_found' => __('No '.$plural_name.' found', 'masked-pdf'),
        'not_found_in_trash' => __('No '.$plural_name.' found in Trash', 'masked-pdf'), 
        'parent_item_colon' => '',
        'menu_name' => __($plural_name, 'masked-pdf')
      );

	 $single_lower = strtolower($single_name);
	 $plural_lower = strtolower($plural_name);

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,

        'show_in_menu' => true,

        'query_var' => true,
        'rewrite' => array('slug' => _x('pdfs', 'URL slug', 'genesis'), 'with_front' => false),
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => PDF_MASK_URL . 'images/pdf-icon.png',

        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail', 'excerpt'),
		'taxonomies' => array('pdf_cat')
    );

    register_post_type($single_lower, $args);
}

