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

/*
class gallery {
	function __construct() {
		$this->$a = '';	
	}

	private function buildTables() {
		// create database gallery
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
*/
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
	public $imageTypes = array('image/jpeg'=>'.jpg','image/png'=>'.png', 'image/gif'=>'.gif');

	public function __construct($data=array()) {
		if (isset($data['id'])) $this->id = (int) $data['id'];
		if (isset($data['user'])) $this->user = $data['user'];
		if (isset($data['uploadDate'])) $this->uploadDate = (int) $data['uploadDate'];
		if (isset($data['title'])) $this->title = $data['title'];
		if (isset($data['imageHash'])) $this->imageHash = $data['imageHash'];
		if (isset($data['mimeType'])) $this->mimeType = $data['mimeType'];
		if (isset($data['attr'])) $this->attr = $data['attr'];
		if (isset($data['album'])) $this->album = $data['album'];
		if (isset($data['tags'])) $this->tags = $data['tags'];
		if (isset($data['votes'])) $this->votes = $data['votes'];
		if (isset($data['views'])) $this->views = $data['views'];
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
		$sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(uploadDate) as uploadDate FROM images WHERE published = 1 ORDER BY id DESC LIMIT :numRows";

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
		$sql = "INSERT INTO images ( user, uploadDate, title, imageHash, mimeType, attr, album, tags, votes, views, published ) VALUES ( :user, FROM_UNIXTIME(:uploadDate), :title, :imageHash, :mimeType, :attr, :album, :tags, :votes, :views, :published)";
		$st = $conn->prepare($sql);
		$st->bindValue(":user", $this->user, PDO::PARAM_STR);
		$st->bindValue(":uploadDate", time(), PDO::PARAM_STR);//his->uploadDate, PDO::PARAM_STR);
		$st->bindValue(":title", $this->title, PDO::PARAM_STR);
		$st->bindValue(":imageHash", $this->imageHash, PDO::PARAM_STR);
		$st->bindValue(":mimeType", $this->mimeType, PDO::PARAM_STR);
		$st->bindValue(":attr", $this->attr, PDO::PARAM_STR);
		$st->bindValue(":album", $this->album, PDO::PARAM_STR);
		$st->bindValue(":tags", $this->tags, PDO::PARAM_STR);
		$st->bindValue(":votes", $this->votes, PDO::PARAM_STR);
		$st->bindValue(":views", $this->views, PDO::PARAM_STR);
		$st->bindValue(":published", $this->published, PDO::PARAM_STR);
		$st->execute();
		$this->id = $conn->lastInsertId();
		$conn = null;
	}	
	
	public static function handleTrueUpload($formData) {

		/*
		 * When the user actually clicks the 'Upload' button
		 * each image $$ set published =1, if album set album =1
		 * 
		 */

	}

	/*
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
	*/
}

class User {
	public static function getUsername($id) {
		// Return the username of an id
		$conn = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "SELECT username FROM users WHERE ID = :id";
		$st = $conn->prepare($sql);
		$st->bindValue(":id", $id, PDO::PARAM_INT);
		$st->execute();
		$row = $st->fetch();
		$conn = null;

		if (isset($row['username'])) return $row['username'];
		return false;
	}

	public static function keyPair($username) {
		/*
		$config = array('private_key_bits' => 512);
		
		// Create the keypair
		$res = openssl_pkey_new($config);
		
		// Get private key
		openssl_pkey_export($res, $privkey);
		
		// Get public key
		$pubkey = openssl_pkey_get_details($res);
		$pubkey = $pubkey["key"];
		
		// Encrypt the data to $encrypted using the public key
		openssl_public_encrypt($username, $encrypted, $pubkey);
		
		// Insert $pubkey, $privkey and $encrypted into temp DB
		// Decrypt the data using the private key and store the results in $decrypted
		// openssl_private_decrypt($encrypted, $decrypted, $privkey);
		*/
		
		$options = [
			'cost' => 12,
		];
		
		$pubkey = password_hash($username, PASSWORD_BCRYPT, $options);
		$privkey = password_hash($pubkey, PASSWORD_BCRYPT, $options);

		$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "INSERT INTO tempKey ( pubkey, privkey, data ) VALUES ( :pubkey, :privkey, :data)";
		$st = $conn->prepare($sql);
		$st->bindValue(":pubkey", $pubkey, PDO::PARAM_STR);
		$st->bindValue(":privkey", $privkey, PDO::PARAM_STR);
		$st->bindValue(":data", $username, PDO::PARAM_STR);
		$st->execute();
		
		$id = $conn->lastInsertId();
		$conn = null;

		$field = "<input type='hidden' name='sks' id='sks' value='$pubkey'>";// style=\"display: none;\" hidden>";
		
		return $field;
	}

	public static function getHashedName($pubkey) {
		$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "SELECT * FROM tempKey WHERE pubkey = :pubkey";
		$st = $conn->prepare($sql);
		$st->bindValue(":pubkey", $pubkey, PDO::PARAM_STR);
		$st->execute();
		$row = $st->fetch();
		
		$conn = null;
		
		return $row['data'];
	}

	/*
	 * echo keyPair("ryan");
	 * getHashedName("$2y$12\$AC2qoRXTIg3AJ6Y3VRDTEe4Xo/eCVAeWtWZOrz6jupZzs8WCEGHdS");
	 *
	 */
	
}

?>

