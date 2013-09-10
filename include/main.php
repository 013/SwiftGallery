<?php
/*
Notes
-----
http://www.killerphp.com/tutorials/object-oriented-php/
http://www.tuxradar.com/practicalphp

search with sphinx
collage - lazy load

http://www.elated.com/articles/cms-in-an-afternoon-php-mysql/

http://stackoverflow.com/questions/549/the-definitive-guide-to-forms-based-website-authentication
http://stackoverflow.com/questions/6928697/the-dreaded-keep-me-logged-in-and-session-checking

1 failed attempt = no delay
2 failed attempts = 5 sec delay
3+ failed attempts = n+5 sec delay
 - submitting (!gallery) n+5second/image
https://github.com/panique/php-login ? Use this ?

--
When the user is entering tags, use
https://github.com/yuku-t/jquery-textcomplete
to autofill common tags

Upload form:
http://blueimp.github.io/jQuery-File-Upload/


--
==
maybe test??
https://peercdn.com/docs
==

*/


class gallery {
	function __construct() {
		$this->$a = '';	
	}

	private function buildTables() {
		/* create database gallery */
		$sql = "CREATE TABLE";
	}

	public function insertRecord() {
		// User
		// Hash
		// Mime type
		// Gallery - 0 if independant image
		// tags
		// date submitted epoch
	}
}

class Image {
	public $id = null;
	public $user = null;
	public $uploadDate = null;
	public $title = null;
	public $imageHash = null;
	public $mimeType = null;
	public $album = null;
	public $tags = null;
	public $published = null;
	public $imageTypes = array('image/JPEG'=>'.jpg','image/PNG'=>'.png');

	public function __construct($data=array()) {
		if (isset($data['id'])) $this->id = (int) $data['id'];
		if (isset($data['user'])) $this->user = $data['user'];
		if (isset($data['uploadDate'])) $this->uploadDate = (int) $data['uploadDate'];
		if (isset($data['title'])) $this->title = $data['title'];
		if (isset($data['imageHash'])) $this->imageHash = $data['imageHash'];
		if (isset($data['mimeType'])) $this->mimeType = $data['mimeType'];
		if (isset($data['album'])) $this->album = $data['album'];
		if (isset($data['tags'])) $this->tags = $data['tags'];
		if (isset($data['published'])) $this->published = (int) $data['published'];
		if (isset($data['pageTitle'])) $this->pageTitle = "Gallery";
	}
	
	public function storeFormValues($params) {
		$this->__construct($params);

		if (isset($params['uploadDate']) ) {
			$uploadDate = explode ('-', $params['uploadDate']);
			if (count($uploadDate) == 3) {
				list($y, $m, $d) = $uploadDate;
				$this->uploadDate = mktime(0, 0, 0, $m, $d, $y);
			}
		}
	}
	
	public static function getById($id) {
		// Get a single image record
		$conn = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "SELECT *, UNIX_TIMESTAMP(uploadDate) as uploadDate FROM images WHERE ID = :id";
		$st = $conn->prepare($sql);
		$st->bindValue(":id", $id, PDO::PARAM_INT);
		$st->execute();
		$row = $st->fetch();
		$conn = null;

		if ($row) return new Image($row);
	}

	public static function getList($numRows=100, $order="uploadDate DESC") {
		// Get front page images
		$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(uploadDate) as uploadDate FROM images ORDER BY uploadDate DESC LIMIT :numRows";

		$st = $conn->prepare($sql);
		$st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
		$st->execute();
		$list = array();

		while ($row = $st->fetch()) {
			$image = new Image($row);
			$list[] = $image;
		}

		$sql = "SELECT FOUND_ROWS() AS totalRows";
		$totalRows = $conn->query($sql)->fetch();
		$conn = null;

		return(array("results"=>$list, "totalRows"=>$totalRows[0]));
	}

	public function insert() {
		//not finished
		$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "INSERT INTO images ( title, etc ) VALUES ( FROM_UNIXTIME(:uploadDate), :title, :etc)";
		$st = $conn->prepare($sql);
		$st->bindValue(":title", $this->title, PDO::PARAM_STR);
		$st->execute();
		$this->id = $conn->lastInsertId();
		$conn = null;
	}
	
	private function hashImage() {
		//$imagePath = "//tmp location 
		$hash = md5_file($imagePath); 
		$dir1 = substr($hash, 0, 4);
		$file1 = substr($hash, 4, 8);
		if (!file_exists($dir1)) mkdir($dir1, 0755);
		//
	}

	public function update() {
		;
	}
	public function delete() {
		;
	}
}

class user extends gallery {
	//$username;
}

?>

