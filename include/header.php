<? session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?=$results['pageTitle'];?></title>
<link href="data:image/x-icon;base64,AAABAAEAEBACAAAAAACwAAAAFgAAACgAAAAQAAAAIAAAAAEAAQAAAAAAQAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAA/4QAAH/+AACAAQAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAgAEAAH/+AACAAQAAf/4AAH/+AAB//gAAf/4AAH/+AAB//gAAf/4AAH/+AAB//gAAf/4AAH/+AAB//gAAf/4AAH/+AACAAQAA" rel="icon" type="image/x-icon" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php"><?=PRODUCT_NAME;?></a>
		</div>
		<ul class="nav navbar-nav">
			<? if (isset($_SESSION['uid'])) { ?>
			<li><a href="?action=user&id=<?=$_SESSION['uid'];?>">User Area</a></li>
			<? } else { ?>
			<li><a href="?action=login">Login</a></li>
        	<li><a href="?action=register">Register</a></li>
	      	<? } ?>
			<li><a href="?action=upload">Upload</a></li>
		</ul>
		<form class="navbar-form navbar-right" role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
			<button type="submit" class="btn btn-ds">Search</button>
		</form>
	</div>
</nav>
	
<div class="container">
	<div class="row">

