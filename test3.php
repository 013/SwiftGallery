<?


//echo gen_uuid();
session_start();
$_SESSION['ryan'] = "hi";
?>

<?

$imageTags = array();



$x = "abc, def, 123";
$y = "456, 789";


$imageTags = array_merge($imageTags, explode(',', $x) );
$imageTags = array_merge($imageTags, explode(',', $y) );

var_dump( $imageTags );

?>

<!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$('.del').click(function() {	
		hash = $(this).attr("id");
		$.get( "del.php", {hash : hash} )
			.done(function( data ) {
				$( "body" ).append( data );
			});
	});
});
</script>

<body>

<span id="myhashled" class="del" style="cursor: pointer;"> &times; </span>

</body>


