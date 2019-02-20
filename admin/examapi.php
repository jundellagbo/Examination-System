<?php
header('Content-Type: application/json');
include "../config.php";
include "../function/function.php";
$id = "";
if(!empty($_GET["auth"] )) {
	$id = $_GET["auth"];
}
if( !isset($_GET["admin"]) || empty($_GET["admin"])) {
	die("You cannot access to this page.");
}
$extension = $id != "" ? " and auth=" . str($id) : "";
$query = "select * from exams where userauth=" . str($_GET["admin"]) . $extension;
$data = array();
foreach (getJSONdata($query) as $key => $value) {
	# code...
	$data[] = $value;
}
echo json_encode($data, JSON_PRETTY_PRINT);