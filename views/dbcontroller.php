<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "couch";
    private $conn;
	
	function __construct() {
        global $conn;
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password);
		return $conn;
	}
	
	function selectDB($conn) {
		mysqli_select_db($conn,$this->database);
	}
	
	function runQuery($query) {
	    global $conn;
		$result = mysqli_query($conn,$query);
        if($result){
		  while($row=mysqli_fetch_assoc($result)){
			$resultset[] = $row;
		  }		
		  if(!empty($resultset))
			 return $resultset;
        }
	}
	
	function numRows($query) {
		$result  = mysqli_query($query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>