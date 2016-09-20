<?php

add_action( 'cmb2_admin_init', 'jsweb_pdf_metabox' );

function jsweb_pdf_metabox() {
	$prefix = '_';

	$jsweb_cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'PDF Data', 'cmb2' ),
		'object_types'  => array( 'pdf', ), 
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, 
	) );
	
	$jsweb_cmb->add_field( array(
		'name' => __( 'PDF Upload', 'cmb2' ),
		'desc' => __( 'Upload a PDF or enter a URL.', 'cmb2' ),
		'id'   => $prefix . 'pdf_upload',
		'type' => 'file',
	) );

}