<?php

require_once('post-types/pdf-post-type.php');
require_once('fields.php');
require_once('rewrite.php');
require_once('taxonomies/pdf-category.php');

 /* Initialize Custom Meta Boxes */
 if ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
}

/* Pull Updates from Github */
require_once('updater/plugin-update-checker.php');
$ist_update_check = PucFactory::getLatestClassVersion('PucGitHubChecker');
$ist_update = new $ist_update_check(
    'https://github.com/prowp/PDF-Path-Mask',
    __FILE__,
    'master'
);

