<?php

function jsweb_create_pdf_taxonomies() {
				$single_name = 'PDF Category';
                $plural_name = 'PDF Categories';
                $post_type_array = array('pdf');

	$labels = array(
		'name'              => _x( $plural_name, 'taxonomy general name' ),
		'singular_name'     => _x($single_Name, 'taxonomy singular name' ),
		'search_items'      => __( 'Search ' . $plural_name ),
		'all_items'         => __( 'All ' . $plural_name ),
		'parent_item'       => __( 'Parent ' . $single_name ),
		'parent_item_colon' => __( 'Parent '.$single_name.':' ),
		'edit_item'         => __( 'Edit ' . $single_name ),
		'update_item'       => __( 'Update ' . $single_name ),
		'add_new_item'      => __( 'Add New ' . $single_name ),
		'new_item_name'     => __( 'New '.$single_name.'  Name' ),
		'menu_name'         => __( $single_name ),
	);

              $single_lower = strtolower($single);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => $single_lower ),
	);

	register_taxonomy( 'pdf_cat', $post_type_array, $args );
}

