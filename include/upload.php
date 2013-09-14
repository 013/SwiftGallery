<?php include "include/header.php" ?>
<!--<link href="css/fineuploader-3.8.2.min.css" rel="stylesheet">-->
<form class="form-horizontal">
<fieldset>

<br>
<div style="width: 200px;">

<div id="fine-uploader">
</div>

</div>


<form id="foo">

<label for="album">Album</label>
<input class="span3" id="album" name="album" type="checkbox"/>

<input type="hidden" name="count" value="1" />

<div class="control-group" id="fields">
<label class="control-label" for="field1">Nice Multiple Form Fields</label>
<div class="controls" id="profs">
<div class="input-append">
<input class="span3" id="field1" name="prof1" type="text" placeholder="Title"/>
<!--<button id="b1" onClick="addFormField()" class="btn btn-info" type="button">+</button>-->
</div>
</div>
</div>


<input type="submit" value="Send" />

</form>


</div>
<?php include "include/footer.php" ?>
