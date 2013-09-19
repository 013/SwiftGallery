<?

function gen_uuid() {
	/*
	 * Generates a v4 UUID
	 * 
	 */
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		// 32 bits for "time_low"
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

		// 16 bits for "time_mid"
		mt_rand( 0, 0xffff ),

		// 16 bits for "time_hi_and_version",
		// four most significant bits holds version number 4
		mt_rand( 0, 0x0fff ) | 0x4000,

		// 16 bits, 8 bits for "clk_seq_hi_res",
		// 8 bits for "clk_seq_low",
		// two most significant bits holds zero and one for variant DCE1.1
		mt_rand( 0, 0x3fff ) | 0x8000,

		// 48 bits for "node"
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	);
}


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


