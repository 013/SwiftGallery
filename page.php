<?
require('include/config.php');
$page = $_GET['page'];
$results = array();
$data = Image::getList($page);

$results['images'] = $data['results'];
$results['totalRows'] = $data['totalRows'];
$results['pageTitle'] = "Gallery";

foreach($results['images'] as $image) { ?>
	<a href="?action=view&id=<?=$image->id;?>"><img class="abc" src="images/<?=substr($image->imageHash, 0,4).'/'.substr($image->imageHash, 4,8).'_thumb'.$image->imageTypes[$image->mimeType];?>" <?=$image->attr; ?>>
</a>

<? }


?>
