<?php
require_once('conn.php');
date_default_timezone_set('Asia/Manila');

$db = new DBConnection();

$getUserDetailsQry = "SELECT * FROM interns WHERE user_id = ? LIMIT 1";
$getUserDetails = $db->conn->prepare($getUserDetailsQry);
$getUserDetails->bind_param('s', $_SESSION['id']);
$getUserDetails->execute();
$userDetails = $getUserDetails->get_result();
$userDetails = $userDetails->fetch_assoc();


// Constant Variables 
$timeAbbreviation = date('A');
$currentTime = date('H:i:s');
$formattedCurrentTime = date('h:i A');
$currentDate = date('Y-m-d');
$intern_id = $userDetails['id'];
$firstname = $userDetails['firstname'];
$middlename = $userDetails['middlename'];
$lastname = $userDetails['lastname'];
$gender = $userDetails['gender'];
$birthdate = $userDetails['birthdate'];
$email = $userDetails['email'];
$status = $userDetails['status'];
$completed_hours = $userDetails['completed_hours'];
$remaining_hours = $userDetails['remaining_hours'];

// Add the total hours worked for this morning
$getTotalWorkedHours_am = $db->conn->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(worked_hours_am))) AS total_worked_hours_am FROM daily_time_records WHERE intern_id = '$intern_id';");
$total_hours_worked_am = $getTotalWorkedHours_am->fetch_assoc()['total_worked_hours_am'];


// Add the total hours worked for this afternoon
$getTotalWorkedHours_pm = $db->conn->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(worked_hours_pm))) AS total_worked_hours_pm FROM daily_time_records WHERE intern_id = '$intern_id';");
$total_hours_worked_pm = $getTotalWorkedHours_pm->fetch_assoc()['total_worked_hours_pm'];


// Update the total hours worked on interns table
$updateTimeQry = "UPDATE interns SET total_hours_worked_am = ?, total_hours_worked_pm = ? WHERE user_id = ?";
$updateTime = $db->conn->prepare($updateTimeQry);
$updateTime->bind_param('sss', $total_hours_worked_am, $total_hours_worked_pm, $_SESSION['id']);
$updateTime->execute();

// Update the completed hours on interns table
$updateCompletedHoursQry = "UPDATE interns SET completed_hours = ADDTIME(total_hours_worked_am, total_hours_worked_pm) WHERE user_id = ?";
$updateCompletedHours = $db->conn->prepare($updateCompletedHoursQry);
$updateCompletedHours->bind_param('s', $_SESSION['id']);
$updateCompletedHours->execute();

// Update the remaining hours on interns table
$updateRemainingHoursQry = "UPDATE interns SET remaining_hours = TIMEDIFF(target_hours, completed_hours) WHERE user_id = ?";
$updateRemainingHours = $db->conn->prepare($updateRemainingHoursQry);
$updateRemainingHours->bind_param('s', $_SESSION['id']);
$updateRemainingHours->execute();

?>