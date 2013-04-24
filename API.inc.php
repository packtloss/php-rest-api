<?php
class API extends REST {

	public $data = "";

	const DB_SERVER = "localhost";
	const DB_USER = "dbuser";
	const DB_PASSWORD = "dbpass";
	const DB = "database";

	private $db = NULL;

	public function __construct(){
		parent::__construct();				// Init REST class contruct
		$this->db_connect();					// Init DB
	}

	// Init DB.
	private function db_connect(){
		$this->db = mysql_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD);
		if($this->db) {
			mysql_select_db(self::DB,$this->db);
		}
	}

	// Base Function - Throw 404 if the method does not exist.
	public function process_api(){
		$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
		//echo $_REQUEST['rquest'];
		if((int)method_exists($this,$func) > 0)
			$this->$func();
		else
			$this->response('',404);
	}




	// ----------------------- REST Functions
	// Testing Functions.
	private function resttest() {
		$result = $_REQUEST;
		$this->response($this->json($result), 200);
	}
	private function posttest() {
		// Only allow POST for this function.
		if($this->get_request_method() != "POST"){
			$this->response('',406);
		} else {
			$result[] = "Rest Posted";
			$result[] = $this->_request['email'];
			$this->response($this->json($result), 200);
		}
	}
	// ----------------------- EOF REST Functions




	// Return json
	private function json($data){
		if(is_array($data)){
			return json_encode($data);
		} else {
			return json_encode($data);
		}
	}
}
?>
