
var next = 0;
function addFormField(Tvalue, title){
	var addto = "#fields";// + next;
	next = next + 1;
	var newIn = '<input id="field' + next + '" name="imgHash' + next + '" type="hidden" value="' + Tvalue + '">';
	//newIn += '<br /><input class="span3" id="title' + next + '" name="imgTitle' + next + '" type="text" value="' + title + '">';
	newIn += '<span id="spantitle'+next+'" class="title '+next+'" >'+title+'</span><input name="imgTitle'+next+'" type="hidden" id="title'+next+'" value="'+title+'">';

	newIn += '<br /><input class="span3" id="tag' + next + '" name="imgTag' + next + '" type="text" value=""><br>';
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
