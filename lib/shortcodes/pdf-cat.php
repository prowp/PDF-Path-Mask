<?php

function pdf_links_func( $atts ) {
     extract( shortcode_atts( array(
	      'cat_id' => '',
     ), $atts ) );
     return pdf_cat_links($cat_id);
}

add_shortcode( 'pdf_links', 'pdf_links_func' );

/* PDF Link List by Category
|  @Since: 0.2.3
|  @Added: 10/15/2016
|  @Author: pro_wp
|  @Tag: shortcode
|  @Variables: PDF Category
*/

function pdf_cat_links($pdf_category) {
	
	$pdf_args = array(
    	'numberposts' => -1,
    	'orderby' => 'post_date',
    	'order' => 'ASC',
    	'post_type' => 'pdf',
    	'post_status' => 'publish' );
	
	/* Add Category if it exists */
	if($pdf_category != ''):
		$pdf_args['tax_query'] = array(
			array(
			    'taxonomy' => 'pdf_cat',
            	'terms' => $pdf_category,
            	'field' => 'term_id',
			));
	endif;

    $pdf_array = get_posts($pdf_args);
	$content = '';
	if(isset($pdf_array)):
	$content = '<div class="pdf-path-links-list"><ul>';
	
	foreach($pdf_array as $pa) {
		$link_id = 'pdf-'.$pa->ID;
		$content .= '<li><a id="'.$link_id.'" href="'.get_permalink($pa->ID).'">'.$pa->post_title.'</a>';
	}
	
	$content .= '</ul></div>';
	endif;
	return $content;	
}
