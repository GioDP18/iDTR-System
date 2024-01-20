<?php

require_once('conn.php');

$db = new DBConnection;
$conn = $db->conn;

class Master extends DBConnection{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
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
		$timeAbbreviation = date('A');
		if($timeAbbreviation === 'AM'){
			$checkQuery = $this->conn->query("SELECT * FROM `daily_time_records` WHERE intern_id = '$intern_id' AND date = '$date'");
			if($checkQuery->num_rows > 0){
				$response['success'] = false;
				$response['message'] = "You have already time-in on this morning.";
			}
			else{
				$stmt = $this->conn->prepare("INSERT INTO `daily_time_records` (intern_id, arrival_am, date) VALUES (?, ?, ?)");
				$stmt->bind_param("sss", $intern_id, $time, $date);
				$result = $stmt->execute();
	
				if($result){
					$response['success'] = true;
				}
				else{
					$response['success'] = false;
					$response['message'] = "There was an error logging your time-in. Please try again later.";
				}
				$stmt->close();
			}
		}
		else{
			$response['success'] = false;
			$response['message'] = "It's already PM.";
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}
	

	function time_out_am(){
		extract($_POST);
		$hour = date('H');
		if($hour <= '12'){
			$checkQuery = $this->conn->query("SELECT * FROM `daily_time_records` WHERE intern_id = '$intern_id' AND date = '$date'");
			if($checkQuery->num_rows < 0){
				$response['success'] = false;
				$response['message'] = "Opss! You have not time-in on this morning.";
			}
			elseif($checkQuery->num_rows === 1){
				$checkResult = $checkQuery->fetch_assoc();
				if(!$checkResult['departure_am']){
					$stmt = $this->conn->prepare("UPDATE `daily_time_records` SET departure_am =? WHERE intern_id =? AND date =?");
					$stmt->bind_param("sss", $time, $intern_id, $date);
					$result = $stmt->execute();
					if($result){
						$response['success'] = true;
					}
					else{
						$response['success'] = false;
						$response['message'] = "There was an error logging your time-out. Please try again later.";
					}
					$stmt->close();
				}
				else{
					$response['success'] = false;
                    $response['message'] = "You have already time-out on this noon.";
				}
				
			}
			else{
				$response['success'] = false;
                $response['message'] = "Your log record for this day has exceeded its limit.";
			}
		}
		else{
			$response['success'] = false;
			$response['message'] = "It's already PM.";
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}
	
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch($action){
	case 'time_in_am':
		echo $Master->time_in_am();
        break;
	case 'time_out_am':
		echo $Master->time_out_am();
        break;

    default:
		break;
}

?>