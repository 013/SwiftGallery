<?php include "include/header.php" ?>
	<div class="Collage">
<?php
$imageTypes = array('image/jpeg'=>'.jpg','image/png'=>'.png', 'image/gif'=>'.gif');
foreach($results['images'] as $image) { ?>
<?
//$att = "images/".substr($image->imageHash, 0,4).'/'.substr($image->imageHash, 4,8).'_thumb'.$imageTypes[$image->mimeType];
//$att = getImageSize($att)[3];
?>
	<a href="?action=view&id=<?=$image->id;?>"><img class="abc" src="images1/<?=substr($image->imageHash, 0,4).'/'.substr($image->imageHash, 4,8).'_thumb'.$image->imageTypes[$image->mimeType];?>" <?=$image->attr; ?>>
</a>

<? } 
	/*
	$image->user;
	$image->uploadDate;
	$image->title;
	$image->imageHash;
	$image->mimeType;
	$image->album;
	$image->tags;
	$image->published;
	*/
?>

	</div>
<?php include "include/footer.php" ?>
