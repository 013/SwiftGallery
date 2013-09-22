<?php
define("DB_DSN", "mysql:host=localhost;dbname=gallery");
define("DB_USERNAME", "gallery_user");
define("DB_PASSWORD", "LxNRmRPnUhnfRV5s");
class qqFileUploader {

    public $allowedExtensions = array();
    public $sizeLimit = null;
    public $inputName = 'qqfile';

    protected $uploadName;
	protected $uploadHash;
	protected $uploadExt;
	protected $uploadType;

    function __construct(){
        $this->sizeLimit = $this->toBytes(ini_get('upload_max_filesize'));
    }

	public function hashExists($imageHash) {
		$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "SELECT * FROM images WHERE imageHash = :hash";
		$st = $conn->prepare($sql);
		$st->bindValue(":hash", $imageHash, PDO::PARAM_STR);
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ($row) return True;
		return False;
	}

    /**
     * Get the original filename
     */
    public function getName(){
        if (isset($_REQUEST['qqfilename']))
            return $_REQUEST['qqfilename'];

        if (isset($_FILES[$this->inputName]))
            return $_FILES[$this->inputName]['name'];
    }

    /**
     * Get the name of the uploaded file
     */
    public function getUploadName(){
        return $this->uploadName;
    }
	public function getUploadHash() {
		return $this->uploadHash;
	}
	public function getUploadExt() {
		return $this->uploadExt;
	}
	public function getUploadType() {
		return $this->uploadType;
	}
    /**
     * Process the upload.
     * @param string $uploadDirectory Target directory.
     * @param string $name Overwrites the name of the file.
     */
    public function handleUpload($uploadDirectory, $username, $name = null){

       // Check that the max upload size specified in class configuration does not
        // exceed size allowed by server config
        if ($this->toBytes(ini_get('post_max_size')) < $this->sizeLimit ||
            $this->toBytes(ini_get('upload_max_filesize')) < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            return array('error'=>"Server error. Increase post_max_size and upload_max_filesize to ".$size);
        }

		// is_writable() is not reliable on Windows (http://www.php.net/manual/en/function.is-executable.php#111146)
		// The following tests if the current OS is Windows and if so, merely checks if the folder is writable;
		// otherwise, it checks additionally for executable status (like before).
		
        $isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
        $folderInaccessible = ($isWin) ? !is_writable($uploadDirectory) : ( !is_writable($uploadDirectory) && !is_executable($uploadDirectory) );

        if ($folderInaccessible){
            return array('error' => "Server error. Uploads directory isn't writable" . ((!$isWin) ? " or executable." : "."));
        }

        if(!isset($_SERVER['CONTENT_TYPE'])) {
            return array('error' => "No files were uploaded.");
        } else if (strpos(strtolower($_SERVER['CONTENT_TYPE']), 'multipart/') !== 0){
            return array('error' => "Server error. Not a multipart request. Please set forceMultipart to default value (true).");
        }

        // Get size and name
		$ext = array("image/png" => ".png", "image/gif"=>".gif","image/jpeg"=>".jpg");
        $file = $_FILES[$this->inputName];
        $type = $file['type'];
		$md5 = md5_file($file['tmp_name']); // Check if MD5 hash already exists in DB [todo]
		
		while ($this->hashExists($md5)) {
			$md5 = md5($md5);
		}
		
		$dir1 = substr($md5, 0, 4);	
		$this->uploadHash = $md5;
		$this->uploadExt = $ext[$type];
		$this->uploadType = $type;
		mkdir('/usr/share/nginx/www/SwiftGallery/images/'.$dir1, 0755);
		$size = $file['size'];

        if ($name === null){
            //$name = $this->getName();
			
			$name = substr($md5, 4,8) . $ext[$type];
        }

        // Validate name

        if ($name === null || $name === ''){
            return array('error' => 'File name empty.');
        }

        // Validate file size

        if ($size == 0){
            return array('error' => 'File is empty.');
        }

        if ($size > $this->sizeLimit){
            return array('error' => 'File is too large.');
        }

        // Validate file extension

        $pathinfo = pathinfo($name);
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

        if($this->allowedExtensions && !in_array(strtolower($ext), array_map("strtolower", $this->allowedExtensions))){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }

        // Save a chunk

        $totalParts = isset($_REQUEST['qqtotalparts']) ? (int)$_REQUEST['qqtotalparts'] : 1;


				$target = $uploadDirectory.'/'.$dir1.'/'.$name;
                $this->uploadName = basename($target);

                if (move_uploaded_file($file['tmp_name'], $target)){
                    return array('success'=> true);
                }

            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
    }
    /**
     * Converts a given size with units to bytes.
     * @param string $str
     */
    protected function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }
}
