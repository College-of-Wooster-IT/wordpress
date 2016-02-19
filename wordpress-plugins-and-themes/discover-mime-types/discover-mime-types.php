<?php
/*
Plugin Name: Discover MIME types
Plugin URI: http://orthogonalcreations.com
Description: This plugin will allow .dta, .sav, and .zip MIME types to be uploaded.
Author: Jon Breitenbucher
Author URI: http://orthogonalcreations.com

Version: 1.0

License: GNU General Public License v2.0 (or later)
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

function addUploadMimes($mimes) {
	$mimes = array_merge($mimes, array(
		// Stata
		'dta' => 'application/x-stata',
		// SPSS
		'sav' => 'application/spss',
		// Zip
		'zip' => 'application/zip'
		));
	return $mimes;
}
add_filter('upload_mimes', 'addUploadMimes');
?>