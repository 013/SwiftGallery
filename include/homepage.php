<?php include "include/header.php" ?>
	<div class="Collage">
<?php
foreach($results['images'] as $image) { ?>
	<a href="?imgid=<?=$image->id;?>"><img class="abc" src="images/thumbs/<?=substr($image->imageHash, 0,4).'/'.substr($image->imageHash, 4,8).$image->imageTypes[$image->mimeType];?>">
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
