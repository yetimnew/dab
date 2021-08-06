<?php
include_once get_template_directory() . '/theme-includes/init.php';
function my_custom_mime_types( $mimes ) {

// New allowed mime types.
$mimes['svg'] = 'image/svg+xml';
$mimes['svgz'] = 'image/svg+xml';
$mimes['doc'] = 'application/msword';

// Optional. Remove a mime type.
unset( $mimes['exe'] );

return $mimes;
}
add_filter( 'upload_mimes', 'my_custom_mime_types' );
