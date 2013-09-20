<?

include('configShort.php');

$term = $_GET['term'];
$terms = array();
$conn = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
$sql = "SELECT tag FROM tags WHERE tag LIKE :term";
$st = $conn->prepare($sql);
//$st->bindValue(":term", $term.'%', PDO::PARAM_STR);
$st->execute(array(':term' => $term.'%'));
$conn = null;

while ($row = $st->fetch()) {
	 array_push($terms, $row['tag']);
}

if (count($terms) >=1) {
	echo json_encode($terms);
}

?>
