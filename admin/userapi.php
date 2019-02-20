
<?php
header('Content-Type: application/json');
include "../config.php";
include "../function/function.php";
if(empty($_GET["admin"]) || !isset($_GET["admin"])) {
	die("You cannot Access this Page.");
}
$query = "select a.id as useridd,a.firstname,lastname,accessid,auth,admin,b.id,b.department from user a join department b on b.id=a.departmentid";
$data = array();
foreach (getJSONdata($query) as $key => $value) {
	# code...
	$data[] = $value;
}
echo json_encode($data, JSON_PRETTY_PRINT);