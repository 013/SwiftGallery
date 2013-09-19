<?php 
include "include/header.php";
include "include/password.php";
 /*
  * Check if user is logged in
  * If not, inform them with a small notification
  *
  */

if (!isset($_SESSION['uid'])) {
	$message = "<small>You are not currently logged in. (<a href=\"index.php?action=login\">Login</a>/<a href=\"index.php?action=register\">Register</a>)</small>";
	$username = "Anonymous";
	$hiddenField = User::keyPair($username);
} else {
	$message = "";
	$username = User::getUsername($_SESSION['uid']);
	/*$options = [
		'cost' => 12,
	];
	$userHash = password_hash($username, PASSWORD_BCRYPT, $options);
	User::insertTempUpload($userHash);
	*/
	// $hiddenField = User::keyPair($username);
	// getHashedName("$2y$12\$AC2qoRXTIg3AJ6Y3VRDTEe4Xo/eCVAeWtWZOrz6jupZzs8WCEGHdS");
}
?>

<link href="css/uploadcss.css" rel="stylesheet">
<link href="css/fineuploader-3.8.2.min.css" rel="stylesheet">

<form class="form-upload" id="foo" method="POST" action="include/uploadconf.php">
	<h2 class="form-upload-heading">Upload</h2>
<?=$hiddenField; ?>
	<div class="form-group">
		<input type="text" class="form-control" id="albumtitle" placeholder="Album Title" name="albumtitle" style="display: none;">
	</div>

<div id="fine-uploader">
</div>
<input type="hidden" name="count" value="1" id="count" />

<div class="control-group" id="fields">
<div class="controls" id="profs">
<div class="input-append">
<!--<input id="field0" name="imageHash0" type="hidden" hidden>
<input id="title0" name="imageTitle0" type="hidden" hidden>-->
</div>
</div>
</div>

<div class="radio">
<label>
<input type="radio" name="albumradio" id="optionsRadios2" value="0" checked>
Upload as individual images
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="albumradio" id="optionsRadios1" value="1">
Group images as album
</label>
</div>
<button class="btn btn-lg btn-primary btn-block" type="submit">Upload</button>
<?=$message; ?>
</form>

<span id="title3" class="title 3" >hi</span>
<input name="title3" type="hidden" id="title3" value="hi">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="js/jquery.fineuploader-3.8.2.min.js" type="text/javascript"></script>

<script src="js/uploadjs.js" type="text/javascript"></script>

<?php include "include/footer.php" ?>
