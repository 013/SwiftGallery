<?php include "include/header.php" ?>
<style>
.form-signin {
	max-width: 530px;
	padding: 15px;
	margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
	margin-bottom: 10px;
}
.form-signin .checkbox {
	font-weight: normal;
}
.form-signin .form-control {
	position: relative;
	font-size: 16px;
	height: auto;
	padding: 10px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
<!--<link href="css/fineuploader-3.8.2.min.css" rel="stylesheet">-->
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">-->

	<form class="form-signin">
	<h2 class="form-signin-heading">Upload</h2>

	<div class="form-group">
		<input type="text" class="form-control" id="title1" placeholder="Title" name="title1">
	</div>

<div class="radio">
<label>
<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
Group images as album
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
Upload as individual images
</label>
</div>

	<button class="btn btn-lg btn-primary btn-block" type="submit">Upload</button>
	</form>

<?php include "include/footer.php" ?>
