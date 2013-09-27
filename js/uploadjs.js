
var next = 0;
function addFormField(Tvalue, title){
	var addto = "#fields";// + next;
	next = next + 1;
	var newIn = '<input id="field' + next + '" name="imgHash' + next + '" type="hidden" value="' + Tvalue + '">';
	newIn += '<span id="' + Tvalue + '" class="del" style="cursor: pointer;"> &times; </span>';
	
	newIn += '<img src="images/'
			+Tvalue.substring(0,4)+'/'+Tvalue.substring(4,12)+'_thumb.'+title.split('.').reverse()[0]+
			'" >';

	newIn += '<span id="spantitle'+next+'" class="title '+next+'" >'+title+'</span><input name="imgTitle'+next+'" type="hidden" id="title'+next+'" value="'+title+'">';
	
	newIn += '<br /><input class="span3" id="tag' + next + '" name="imgTag' + next + '" type="text" value=""><br>';
	var newInput = $(newIn);
	$(addto).after(newInput);
	$("#field" + next).attr('data-source',$(addto).attr('data-source'));
	$("#count").val(next);
}


$(document).ready(function() {
	$('.del').on('click', function() {	
		hash = $(this).attr("id");
		$.post( "include/del.php", {imageHash : hash} )
			.done(function( data ) {
				$( "body" ).append( data );
			});
	});

	
	$("#fine-uploader").fineUploader({
		debug: true,
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
