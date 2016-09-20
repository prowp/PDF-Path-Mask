<?php

/* PDF Rewrite Rules */
add_action( 'init', 'pdf_rewrite_rule', 1 );
function pdf_rewrite_rule() {
			add_rewrite_rule(
		'pdfs/([^/]+)(/[0-9]+)?.pdf$',
		'index.php?post_type=pdf&name=$matches[1]',
		'top'
		);


}

function append_pdf_to_url( $url, $post ) {
    if ( 'pdf' == get_post_type( $post ) ) {
        return $url . '.pdf';
    }
    return $url;
}
add_filter( 'post_type_link', 'append_pdf_to_url', 10, 2 );