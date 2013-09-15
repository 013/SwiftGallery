<?php include "include/header.php" ?>
	<div class="Collage">
<?php
$imageTypes = array('image/jpeg'=>'.jpg','image/png'=>'.png');
foreach($results['images'] as $image) { ?>
	<a href="?action=view&id=<?=$image->id;?>"><img class="abc" src="images/<?=substr($image->imageHash, 0,4).'/'.substr($image->imageHash, 4,8).'_thumb'.$imageTypes[$image->mimeType];?>">
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
