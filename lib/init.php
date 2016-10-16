<?php

require_once('post-types/pdf-post-type.php');
require_once('fields.php');
require_once('rewrite.php');
require_once('taxonomies/pdf-category.php');
require_once('shortcodes/pdf-cat.php');

 /* Initialize Custom Meta Boxes */
 if ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
}



