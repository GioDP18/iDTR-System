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
			$response['status'] = 'failed';
			$response['error'] = $this->conn->error;
			return json_encode($response);
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
					if($time > '08:00:00'){
						$this->conn->query("UPDATE daily_time_records SET late_am = TIMEDIFF(arrival_am, STR_TO_DATE('08:00:00', '%H:%i:%s')) WHERE intern_id = '$intern_id' AND date = '$date'");
					}
					$this->conn->query("UPDATE `interns` SET status = 1 WHERE id = '$intern_id'");
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
			if($checkQuery->num_rows <= 0){
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
						$this->conn->query("UPDATE daily_time_records SET worked_hours_am = TIMEDIFF(departure_am, arrival_am) WHERE intern_id = '$intern_id' AND date = '$date'");
						$this->conn->query("UPDATE `interns` SET status = 0 WHERE id = '$intern_id'");
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

	function time_in_pm(){
		extract($_POST);
		$timeAbbreviation = date('A');
		if($timeAbbreviation === 'PM'){
			$checkQuery = $this->conn->query("SELECT * FROM `daily_time_records` WHERE intern_id = '$intern_id' AND date = '$date'");
			if($checkQuery->num_rows <= 0){
				$stmt = $this->conn->prepare("INSERT INTO `daily_time_records` (intern_id, arrival_pm, date) VALUES(?, ?, ?)");
				$stmt->bind_param("sss", $intern_id, $time, $date);
				$result = $stmt->execute();
				if($result){
					if($time > '13:00:00'){
						$this->conn->query("UPDATE daily_time_records SET late_pm = TIMEDIFF(arrival_pm, STR_TO_DATE('13:00:00', '%H:%i:%s')) WHERE intern_id = '$intern_id' AND date = '$date'");
					}
					$this->conn->query("UPDATE `interns` SET status = 1 WHERE id = '$intern_id'");
					$response['success'] = true;
				}
				else{
					$response['success'] = false;
					$response['message'] = "There was an error logging your time-in. Please try again later.";
				}
				$stmt->close();
			}
			elseif($checkQuery->num_rows === 1){
				$checkResult = $checkQuery->fetch_assoc();
				if(!$checkResult['arrival_pm']){
					$stmt = $this->conn->prepare("UPDATE `daily_time_records` SET arrival_pm =? WHERE intern_id =? AND date =?");
					$stmt->bind_param("sss", $time, $intern_id, $date);
					$result = $stmt->execute();
					if($result){
						if($time > '13:00:00'){
							$this->conn->query("UPDATE daily_time_records SET late_pm = TIMEDIFF(arrival_pm, STR_TO_DATE('13:00:00', '%H:%i:%s')) WHERE intern_id = '$intern_id' AND date = '$date'");
						}
						$this->conn->query("UPDATE `interns` SET status = 1 WHERE id = '$intern_id'");
						$response['success'] = true;
					}
					else{
						$response['success'] = false;
						$response['message'] = "There was an error logging your time-in. Please try again later.";
					}
					$stmt->close();
				}
				else{
					$response['success'] = false;
                    $response['message'] = "You have already time-in on this afternoon.";
				}
				
			}
			else{
				$response['success'] = false;
                $response['message'] = "Your log record for this day has exceeded its limit.";
			}
		}
		else{
			$response['success'] = false;
			$response['message'] = "It's morning, you can log here later.";
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}

	function time_out_pm(){
		extract($_POST);
		$timeAbbreviation = date('A');
		if($timeAbbreviation === 'PM'){
			$checkQuery = $this->conn->query("SELECT * FROM `daily_time_records` WHERE intern_id = '$intern_id' AND date = '$date'");
			if($checkQuery->num_rows <= 0){
				$response['success'] = false;
				$response['message'] = "Opss! You have not time-in on this day.";
			}
			elseif($checkQuery->num_rows === 1){
				$checkResult = $checkQuery->fetch_assoc();
				if(!$checkResult['departure_pm']){
					$stmt = $this->conn->prepare("UPDATE `daily_time_records` SET departure_pm =? WHERE intern_id =? AND date =?");
					$stmt->bind_param("sss", $time, $intern_id, $date);
					$result = $stmt->execute();
					if($result){
						$this->conn->query("UPDATE daily_time_records SET worked_hours_pm = TIMEDIFF(departure_pm, arrival_pm) WHERE intern_id = '$intern_id' AND date = '$date'");
						$this->conn->query("UPDATE `interns` SET status = 0 WHERE id = '$intern_id'");
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
                    $response['message'] = "You have already time-out on this afternoon.";
				}
				
			}
			else{
				$response['success'] = false;
                $response['message'] = "Your log record for this day has exceeded its limit.";
			}
		}
		else{
			$response['success'] = false;
			$response['message'] = "It's morning, you can log here later.";
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}

	function create_new_report(){
		extract($_POST);
        $stmt = $this->conn->prepare("INSERT INTO `reports` (intern_id, report_title, report_content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $intern_id, $report_title, $report_content);
        $result = $stmt->execute();
        if($result){
            $response['success'] = true;
        }
        else{
            $response['success'] = false;
			$response['message'] = "There was an error creating your report. Please try again later.";
        }
        $stmt->close();
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
	}

	function start_overtime(){
		extract($_POST);
		$checkQuery = $this->conn->query("SELECT * FROM `daily_time_records` WHERE intern_id = '$intern_id' AND date = '$date'");
		if($checkQuery->num_rows > 0){
			$checkResult = $checkQuery->fetch_assoc();
			if(!$checkResult['overtime_start']){
				$stmt = $this->conn->prepare("UPDATE `daily_time_records` SET overtime_start =? WHERE intern_id =? AND date =?");
				$stmt->bind_param("sss", $time, $intern_id, $date);
				$result = $stmt->execute();

				if($result){
					$this->conn->query("UPDATE `interns` SET overtime_status = 1 WHERE id = '$intern_id'");
					$response['success'] = true;
				}
				else{
					$response['success'] = false;
					$response['message'] = "There was an error starting your overtime. Please try again later.";
				}
				$stmt->close();
			}
			else{
				$response['success'] = false;
                $response['message'] = "You have already overtime this day.";
			}
		}
		else{
			$stmt = $this->conn->prepare("INSERT INTO `daily_time_records` (intern_id, overtime_start, date) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $intern_id, $time, $date);
			$result = $stmt->execute();

			if($result){
				$this->conn->query("UPDATE `interns` SET overtime_status = 1 WHERE id = '$intern_id'");
				$response['success'] = true;
			}
			else{
				$response['success'] = false;
				$response['message'] = "There was an error starting your overtime. Please try again later.";
			}
			$stmt->close();
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}

	function stop_overtime(){
		extract($_POST);
		$stmt = $this->conn->prepare("UPDATE `daily_time_records` SET overtime_end =? WHERE intern_id =? AND date =?");
		$stmt->bind_param("sss", $time, $intern_id, $date);
		$result = $stmt->execute();
		if($result){
			$this->conn->query("UPDATE daily_time_records SET overtime_duration = TIMEDIFF(overtime_end, overtime_start) WHERE intern_id = '$intern_id' AND date = '$date'");
			$this->conn->query("UPDATE `interns` SET overtime_status = 0 WHERE id = '$intern_id'");
			$response['success'] = true;
		}
		else{
			$response['success'] = false;
			$response['message'] = "There was an error logging your overtime. Please try again later.";
		}
		$stmt->close();
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
	case 'time_in_pm':
		echo $Master->time_in_pm();
		break;
	case 'time_out_pm':
		echo $Master->time_out_pm();
		break;
	case 'create_new_report':
		echo $Master->create_new_report();
		break;
	case 'start_overtime':
		echo $Master->start_overtime();
		break;
	case 'stop_overtime':
		echo $Master->stop_overtime();
		break;

    default:
		break;
}

?>