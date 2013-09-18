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
<style>
.form-upload {
	max-width: 530px;
	padding: 15px;
	margin: 0 auto;
}
.form-upload .form-upload-heading,
.form-upload .checkbox {
	margin-bottom: 10px;
}
.form-upload .checkbox {
	font-weight: normal;
}
.form-upload .form-control {
	position: relative;
	font-size: 16px;
	height: auto;
	padding: 10px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.qq-upload-list {
	text-align: left;
}

      /* For the bootstrapped demos */
      li.alert-success {
        background-color: #DFF0D8;
      }

      li.alert-error {
        background-color: #F2DEDE;
      }

      .alert-error .qq-upload-failed-text {
        display: inline;
      }
    </style>



<link href="css/fineuploader-3.8.2.min.css" rel="stylesheet">
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">-->


<!--
<form id="foo">

<input type="hidden" name="count" value="1" />

<div class="control-group" id="fields">
<div class="controls" id="profs">
<div class="input-append">
<input id="field0" name="imageHash0" type="hidden" hidden>
<input id="title0" name="imageTitle0" type="hidden" hidden>
</div>
</div>
</div>



</form>
-->



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



<!--  ######  -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!--
<span id="title3" class="title 3" >hi</span>
<input name="title3" type="hidden" id="title3" value="hi">


<span id="foo" class="title 4" >hi</span>
<input name="title4" type="hidden" id="title4" value="hi">


<span id="foo" class="title 5" >hi</span>
<input name="title5" type="hidden" id="title5" value="hi">
-->
<!-- #######  -->

<script src="js/jquery.fineuploader-3.8.2.min.js" type="text/javascript"></script>

<script type="text/javascript">

	
var next = 0;
function addFormField(Tvalue, title){
	var addto = "#fields";// + next;
	next = next + 1;
	var newIn = '<input id="field' + next + '" name="imgHash' + next + '" type="hidden" value="' + Tvalue + '">';
	//newIn += '<br /><input class="span3" id="title' + next + '" name="imgTitle' + next + '" type="text" value="' + title + '">';
	newIn += '<span id="spantitle'+next+'" class="title '+next+'" >'+title+'</span><input name="imgTitle'+next+'" type="hidden" id="title'+next+'" value="'+title+'">';

	newIn += '<br /><input class="span3" id="tag' + next + '" name="imgTag' + next + '" type="text" value="">';
	var newInput = $(newIn);
	$(addto).after(newInput);
	$("#field" + next).attr('data-source',$(addto).attr('data-source'));
	$("#count").val(next);
}


$(document).ready(function() {
	
	
	
	$("#fine-uploader").fineUploader({
		debug: false,
		request: {
			endpoint: 'include/handleUpload.php'
		},
		text: {
			uploadButton: '<div><i class="icon-upload icon-white"></i> + Add Image </div>'
		},
		template: '<div class="qq-uploader span12">' +
		'<pre class="qq-upload-drop-area span12"><span>{dragZoneText}</span></pre>' +
		'<div class="qq-upload-button btn btn-success" style="width: auto;">{uploadButtonText}</div>' +
		'<span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>' +
		'<ul class="qq-upload-list" style="margin-top: 10px; text-align: center; "></ul>' +
		'</div>',
		classes: {
			success: 'alert alert-success ',
			fail: 'alert alert-error'
		},
		editFilename: {
			enabled: false
		},
		deleteFile: {
			enabled: false,//true,
			endpoint: 'include/handleUpload.php'
		},
		retry: {
			enableAuto: true
		},
		autoUpload: true
	}).on('complete', function(event, id, fileName, responseJSON) {
		if (responseJSON.success) {
			// Append image to somewhere in form
			/*$(this).append(
			'<img src="images/'
			+responseJSON.md5.substring(0,4)+'/'+responseJSON.md5.substring(4,12)+'_thumb.'+fileName.split('.').reverse()[0]+
			'" >'
			);*/
			
			$( ".alert-success" ).fadeOut( 1600 )

			addFormField(responseJSON.md5, fileName);//responseJSON.uploadName)
		}
	});


/*
	// variable to hold request
	//var request;
	// bind to the submit event of our form
	//$("#foo").submit(function(event){
	    // abort any pending request
	    if (request) {
	request.abort();
		}
		// setup some local variables
		var $form = $(this);
		// let's select and cache all the fields
		var $inputs = $form.find("input, select, button, textarea");
		// serialize the data in the form
		var serializedData = $form.serialize();
		// let's disable the inputs for the duration of the ajax request
		$inputs.prop("disabled", true);
		// fire off the request to /form.php
		request = $.ajax({
			url: "include/form.php",
			type: "post",
			data: serializedData
		});
		// callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR){
			// log a message to the console
			console.log(response);
			console.log("Hooray, it worked!");
		});
		// callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown){
			// log the error to the console
			console.error(
			"The following error occured: "+
			textStatus, errorThrown
			);
		});
		// callback handler that will be called regardless
		// if the request failed or succeeded
		request.always(function () {
			// reenable the inputs
			$inputs.prop("disabled", false);
		});
		// prevent default posting of form
		event.preventDefault();
	});
*/
		var active = false;	
		$('#foo').on('focusout', function() {
			//alert(this.attr('id'));
			if (!$("#fooI").is(":focus")) {
				hiddenTitle = "#title" + $("#fooI").attr('class');//.split(' ')[1]
				nTitle = "#spantitle" + $("#fooI").attr('class');//.split(' ')[1]
				$(hiddenTitle).val($('#fooI').val());
				$(nTitle).html($('#fooI').val());
				active = false;
			}
		});

	$('#foo').on('click', '.title', function() {
		if (!active) {
			active = true;
			Fclass = $(this).attr('class').split(' ')[1]
			$(this).html("<input type=\"text\" class=\""+Fclass+"\" id=\"fooI\" value=\""+$(this).html()+"\">");
			$('#fooI').focus();
		}
	});


	
	
	$( "input[type='radio']" ).change(function() {
		if( $( this ).val() == 0) {
			$( "#albumtitle" ).fadeOut( 600 )
		} else {
			$( "#albumtitle" ).fadeIn( 600 )
		}
	});



});
</script>

<?php include "include/footer.php" ?>
