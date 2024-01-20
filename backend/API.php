<?php

require_once('conn.php');

$db = new DBConnection;
$conn = $db->conn;

class Master extends DBConnection{
	public function __construct(){
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}


    function time_in_am(){
		extract($_POST);
		$intern_id = $_POST['intern_id'];
		$time = $_POST['time'];
		$sql = "INSERT INTO `daily_time_records` (intern_id, arrival_am, date) VALUES ('$intern_id', '$time', '$date')";
		$result = $this->conn->query($sql);
		if($result){
			$response['success'] = True;
		}
		else{
            $response['success'] = False;
        }
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch($action){
	case 'time_in_am':
		echo $Master->time_in_am();
        break;


    default:
		break;
}

?>