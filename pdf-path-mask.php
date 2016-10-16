<?php
/*
  Plugin Name: PDF Path Mask
  Description: Adds a post type to WordPress that will mask your actual PDF Url
  Author: <a href="mailto:john@jsweb.solutions">John Russell</a> | <a href="http://www.jsweb.solutions">JS Web Solutions</a>
  Version: 0.2.3
 */
 
 define('PDF_MASK_URL', plugins_url('/',  __FILE__));
 
 require_once('lib/init.php');
 



/* Intercepts Request and Renders PDF Instead of WP */
add_action('wp', 'single_pdf_layout');

	function single_pdf_layout() {
		if(is_singular('pdf')):
		global $post;
		$url = get_post_meta($post->ID, '_pdf_upload', true);
		if($url):
		masked_pdf_render($url);
		endif;
		endif;
}

	/* PDF Functions */
		
	function masked_pdf_render($url) {
        $mm_type="application/pdf";

        header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: " . $mm_type);
		//header("Content-Length: " .(string)(filesize($url)) );
		header('Content-Disposition: inline; filename="'.basename($url).'"');
		header("Content-Transfer-Encoding: binary\n");

		readfile($url); // outputs the content of the file

        exit();
		
	}
	
/* Install Post Types and Taxonomies */
register_activation_hook( __FILE__, 'masked_pdf_activate' );

	function masked_pdf_activate() {
		masked_pdf_post_type();
		jsweb_create_pdf_taxonomies();
		pdf_rewrite_rule();
		flush_rewrite_rules();
	}
	
/* Clean up Rewrite Rules */	
register_deactivation_hook( __FILE__, 'masked_pdf_deactivation' );

function masked_pdf_deactivation() {
	
	flush_rewrite_rules(true);
}

/* Pull Updates from Github */
require_once('lib/updater/plugin-update-checker.php');
$pdf_mask_update_check = PucFactory::getLatestClassVersion('PucGitHubChecker');
$pdf_mask_update = new $pdf_mask_update_check(
    'https://github.com/prowp/PDF-Path-Mask',
    __FILE__,
    'master'
);