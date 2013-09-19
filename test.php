<?php
require('include/config.php');
$results['pageTitle'] = "Test";
require('include/header.php');

?>

<script type="text/javascript">

//var timeout = 5000;
var z = true;
var p = 0;
$(document).ready(function () {
	$(window).scroll(function() {
		window.location.hash = p
		p+=1;
		if ($('#bottom').offset().top < ($(window).height() + $(window).scrollTop()) &&
			($('#bottom').offset().top + $('#bottom').outerHeight()) > $(window).scrollTop() && z) {
			z = false;
			$('#bottom').html('Loading...');
			setTimeout(function(){ z=true },3000);
		}
	});
});

</script>


<div id="content" style="background-color: #ff0000; ">
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
Hi<br>
</div>


<div id="bottom">0</div>

<?

require('include/footer.php');
?>

