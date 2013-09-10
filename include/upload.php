<?php include "include/header.php" ?>
	<div class="form">
<div class="content-box">
<div class="clear">						
<input type="file" name="imgfile" multiple="" accept="image/*" id="upload-btn">
<button id="uploadBtn">Upload</button>
<span style="padding-left: 5px; vertical-align: middle;"><i>PNG, JPG, or GIF (500K max file size)</i></span>
<div class="clearfix redtext" id="errormsg">
</div>	              
<div style="margin-top: 10px; margin-bottom: 10px;" class="progress-wrap" id="pic-progress-wrap">
</div>	
<div style="padding-top: 0px; padding-bottom: 10px;" class="clear" id="picbox">
</div>
</div>
</div>
</div>
<script src="js/SimpleAjaxUploader.min.js" type="text/javascript"/>
<script>

$(function() {
var uploader = new ss.SimpleUpload({
	button: $('#uploadBtn'), // upload button
	url: 'include/uptest.php', // URL of server-side upload handler
	name: 'userfile', // parameter name of the uploaded file
	onSubmit: function() {
	this.setProgressBar( $('#progressBar') ); // designate elem as our progress bar
	},
	onComplete: function(file, response) {
		// do whatever after upload is finished
	}
});
});
</script>
<?php include "include/footer.php" ?>
