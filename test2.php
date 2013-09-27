<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<!--
<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">

<script src="js/jquery-ui-1.10.3.custom.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!--
<script type="text/javascript">
 $(function() {
	 function split( val ) {
		 return val.split( /,\s*/ );
	 }
	 function extractLast( term ) {
		 return split( term ).pop();
	 }
	 $( "#birds" )
	 // don't navigate away from the field on tab when selecting an item
	 .bind( "keydown", function( event ) {
		 if ( event.keyCode === $.ui.keyCode.TAB &&
			 $( this ).data( "ui-autocomplete" ).menu.active ) {
			 event.preventDefault();
		 }
	 })
	 .autocomplete({
		 source: function( request, response ) {
			 $.getJSON( "include/tags.php", {
				 term: extractLast( request.term )
			 }, response );
		 },
		 search: function() {
			 // custom minLength
			 var term = extractLast( this.value );
			 if ( term.length < 1 ) {
				 return false;
			 }
		 },
		 focus: function() {
			 // prevent value inserted on focus
			 return false;
		 },
		 select: function( event, ui ) {
			 var terms = split( this.value );
			 // remove the current input
			 terms.pop();
			 // add the selected item
			 terms.push( ui.item.value );
			 // add placeholder to get the comma-and-space at the end
			 terms.push( "" );
			 this.value = terms.join( ", " );
			 return false;
		 }
	 });
 });
</script>


<div class="ui-widget">
<label for="birds">Tags: </label>
<input id="birds" size="50" />
</div>
-->
<script type="text/javascript">
$(document).ready(function() {

$('.hi').on('mouseover', function() {
	    $('.showme').slideDown();
});

$('.hi').mouseout(function() {
	    window.isoverdiv = false;
	    setTimeout(function() {
	        if (!window.isoverdiv) {
		        $('.showme').slideUp();
		    }
	 }, 200);
});

$('.showme').mouseover(function() {
	    window.isoverdiv = true;
});

});
</script>
<style>
.hi { width:250px; height:187px; overflow: hidden; }
.button {width:250px; height:187px; position:fixed; overflow: hidden; }
.showme {width:245px; height:30px; position:fixed; background: rgba(25, 25, 25, 0.5); display:none; cursor: pointer; color: #fff; padding: 5px 0px 0px 5px; overflow: hidden; }
</style>

<div class="hi">
<div class="button">
<img style="z-index: -1;" src="http://ryan.swiftler.com/SwiftGallery/images/bdf3/bf1da340_thumb.jpg">
</div>
<div class="showme">
     Title ~~~
	 <span class="pull-right glyphicon glyphicon-remove-sign"></span>
</div>
</div>
<!--
<div>
<span></span>
</div>

-->
