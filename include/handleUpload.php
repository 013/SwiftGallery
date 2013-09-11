<?php

// Include the uploader class
require_once 'qqFileUploader.php';

$uploader = new qqFileUploader();

// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
$uploader->allowedExtensions = array("jpeg", "jpg", "png", "gif");

// Specify max file size in bytes.
$uploader->sizeLimit = 20 * 1024 * 1024;

// Specify the input name set in the javascript.
$uploader->inputName = 'qqfile';

// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
$result = $uploader->handleUpload('../images');

// To save the upload with a specified name, set the second parameter.
// $result = $uploader->handleUpload('uploads/', md5(mt_rand()).'_'.$uploader->getName());

// To return a name used for uploaded file you can use the following line.
$result['uploadName'] = $uploader->getUploadName();
$result['md5'] = $uploader->getUploadHash();
$ext = $uploader->getUploadExt();

$x = substr($result['md5'], 0, 4) . '/'. substr($result['md5'], 4, 8).$ext;

$command = './thumb.py ../images/'.$x.' '.$ext;
//file_put_contents('log.txt', $command);

exec($command);

header("Content-Type: text/plain");
echo json_encode($result);


?>


