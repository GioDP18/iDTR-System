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
$currentTime = date('h:i A');
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
?>