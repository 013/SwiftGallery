<?
require('include/config.php');

/*
 * Scrolling through the home page
 * Upon reaching the bottom reqest page.php?page=2
 * Which will retrieve the html and append to the page
 * Then page.php?page=3
 *
 * Need to add functionality filter results and get pages for search terms, etc etc
 *
 */

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
