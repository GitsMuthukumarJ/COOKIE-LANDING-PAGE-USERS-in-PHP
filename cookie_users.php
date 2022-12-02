<?php
/*
 * Template Name: Home Template
 */
session_start();
if (!isset($_SESSION['id'])) {
	$_SESSION['id'] = $_COOKIE['ID'];
}
if (!isset($_SESSION['doctor_id'])) {
	$_SESSION['doctor_id'] = $_COOKIE['DOCTOR_ID'];
}
include "header.php";
include "db.php";

$user_ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('Asia/Kolkata');
$date_time = date('d-m-Y H:i:s');

$ipdat = @json_decode(file_get_contents(
  "http://www.geoplugin.net/json.gp?ip=" . $user_ip
));

$ip_country = $ipdat->geoplugin_countryName;
$ip_city = $ipdat->geoplugin_city;
$ip_timezone = $ipdat->geoplugin_timezone;
$ip_gsm_data = $ip_country . ', ' . $ip_city . ', ' . $ip_timezone;

$sql22="INSERT INTO home_page_visitors(user_ip, user_location, user_timezone, date_time)VALUES('$user_ip','$ip_gsm_data','$ip_timezone','$date_time')";
$result22=$page_connect->query($sql22);
?>
