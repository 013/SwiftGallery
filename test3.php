<?


//echo gen_uuid();
session_start();
//$_SESSION['ryan'] = "hi";
?>

<?

$imageTags = array();

$x = "abc, def, 123";
$y = "456, 789";

$imageTags = array_merge($imageTags, explode(',', $x) );
$imageTags = array_merge($imageTags, explode(',', $y) );

?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$('.del').click(function() {	
		hash = $(this).attr("id");
		$.post( "include/del.php", {imageHash : hash} )
			.done(function( data ) {
				$( "body" ).append( data );
			});
	});
});
</script>

<body>

<span id="9d377b10ce778c4938b3c7e2c63a229a" class="del" style="cursor: pointer;"> &times; </span>

</body>


