<?php
/*
  Plugin Name: PDF Path Mask
  Description: Adds a post type to WordPress that will mask your actual PDF Url
  Author: <a href="mailto:john@jsweb.solutions">John Russell</a> | <a href="http://www.jsweb.solutions">JS Web Solutions</a>
  Version: 0.3
 */
 
 define('PDF_MASK_URL', plugins_url('/',  __FILE__));
 
 require_once('lib/init.php');
 



/* Intercepts Request and Renders PDF Instead of WP */
add_action('template_redirect', 'single_pdf_layout');

	function single_pdf_layout() {
		if(is_singular('pdf')):
		global $post;
		do_action('pre_pdf_render', $post->ID);	
		$url = get_post_meta($post->ID, '_pdf_upload', true);
		if($url):
		masked_pdf_render($url);
		endif;
		endif;
}

	/* PDF Functions */
		
	function masked_pdf_render($url) {
        $mm_type="application/pdf"; 
		$file_size = jsweb_get_pdf_file_size( $url );

        header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: " . $mm_type);
		header("Content-Length: " .$file_size ); 
		header('Content-Disposition: inline; filename="'.basename($url).'"');
		header("Content-Transfer-Encoding: binary\n");
		



		readfile($url); // outputs the content of the file
		

        exit();
		
	}

function jsweb_get_pdf_file_size( $url ) {
  // Assume failure.
  $result = -1;

  $curl = curl_init( $url );

  // Issue a HEAD request and follow any redirects.
  curl_setopt( $curl, CURLOPT_NOBODY, true );
  curl_setopt( $curl, CURLOPT_HEADER, true );
  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
  //curl_setopt( $curl, CURLOPT_USERAGENT, get_user_agent_string() );

  $data = curl_exec( $curl );
  curl_close( $curl );

  if( $data ) {
    $content_length = "unknown";
    $status = "unknown";

    if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
      $status = (int)$matches[1];
    }

    if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
      $content_length = (int)$matches[1];
    }

    if( $status == 200 || ($status > 300 && $status <= 308) ) {
      $result = $content_length;
    }
  }

  return $result;
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
