<?php include "include/header.php" ?>
<link href="css/fineuploader-3.8.2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
 <style>
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


<div style="width: 200px;">

<div id="fine-uploader">
</div>

</div>


<form id="foo">



<input type="hidden" name="count" value="1" />
<div class="control-group" id="fields">
<label class="control-label" for="field1">Nice Multiple Form Fields</label>
<div class="controls" id="profs">
<div class="input-append">
<input autocomplete="off" class="span3" id="field1" name="prof1" type="text" placeholder="Title"/><button id="b1" onClick="addFormField()" class="btn btn-info" type="button">+</button>
</div>
</div>
</div>


<input type="submit" value="Send" />

</form>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="js/jquery.fineuploader-3.8.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
	$("#fine-uploader").fineUploader({
		debug: true,
		request: {
			endpoint: 'include/handleUpload.php'
		},
		text: {
			uploadButton: '<div><i class="icon-upload icon-white"></i> + </div>'
		},
		template: '<div class="qq-uploader span12">' +
		'<pre class="qq-upload-drop-area span12"><span>{dragZoneText}</span></pre>' +
		'<div class="qq-upload-button btn btn-success" style="width: auto;">{uploadButtonText}</div>' +
		'<span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>' +
		'<ul class="qq-upload-list" style="margin-top: 10px; text-align: center;"></ul>' +
		'</div>',
		classes: {
			success: 'alert alert-success',
			fail: 'alert alert-error'
		},
		deleteFile: {
			enabled: false,//true,
			endpoint: 'include/handleUpload.php'
		},
		retry: {
			enableAuto: true
		}
	}).on('complete', function(event, id, fileName, responseJSON) {
		if (responseJSON.success) {
			// Append image to somewhere in form
			$(this).append(
			'<img src="images/'
			+responseJSON.md5.substring(0,4)+'/'+responseJSON.md5.substring(4,12)+'_thumb.'+fileName.split('.').reverse()[0]+
			'" >'
			);
			addFormField(responseJSON.md5)
		}
	});



	// variable to hold request
	var request;
	// bind to the submit event of our form
	$("#foo").submit(function(event){
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









});


var next = 1;
function addFormField(Tvalue){
	var addto = "#field" + next;
	next = next + 1;
	var newIn = '<br /><br /><input autocomplete="off" class="span3" id="field' + next + '" name="field' + next + '" type="text" data-provide="typeahead" data-items="8" value="' + Tvalue + '">';
	var newInput = $(newIn);
	$(addto).after(newInput);
	$("#field" + next).attr('data-source',$(addto).attr('data-source'));
	$("#count").val(next);
}


</script>

</div>
<?php include "include/footer.php" ?>
