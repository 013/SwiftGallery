<?php

// Include the uploader class
require_once 'qqFileUploader.php';
require('main.php');
session_start();
$uploader = new qqFileUploader();

// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
$uploader->allowedExtensions = array("jpeg", "jpg", "png", "gif");

// Specify max file size in bytes.
$uploader->sizeLimit = 20 * 1024 * 1024;

// Specify the input name set in the javascript.
$uploader->inputName = 'qqfile';

/*
if (isset($_SESSION['uid'])) {
	$username = $_SESSION['uid'];
} else {
	$username = "Anonymous";
}
*/
$username = $_SESSION['username'];

// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
$result = $uploader->handleUpload('../images', $username);

// To save the upload with a specified name, set the second parameter.
// $result = $uploader->handleUpload('uploads/', md5(mt_rand()).'_'.$uploader->getName());

// To return a name used for uploaded file you can use the following line.
$result['uploadName'] = $uploader->getUploadName();
$result['md5'] = $uploader->getUploadHash();
$ext = $uploader->getUploadExt();
$type = $uploader->getUploadType();

$x = substr($result['md5'], 0, 4) . '/'. substr($result['md5'], 4, 8).$ext;

$command = './thumb.py ../images/'.$x.' '.$ext;
exec($command);
//file_put_contents('log.txt', $command);

$x = '/usr/share/nginx/www/SwiftGallery/images/'.substr($result['md5'], 0, 4) . '/'. substr($result['md5'], 4, 8).'_thumb'.$ext;
$attr = getImageSize($x)[3];

$values = array(
	'user' => $username,
	'uploadDate' => time(),
	'title' => $result['uploadName'],
	'imageHash' => $result['md5'],
	'mimeType' => $type,
	'attr' => $attr,
	'album' => 0,
	'tags' => '',
	'votes' => 0,
	'views' => 0,
	'published' => 0
);

// Insert image into DB
$image = new Image;
$image->storeFormValues( $values );
$image->insert();
//

header("Content-Type: text/plain");
echo json_encode($result);


?>


