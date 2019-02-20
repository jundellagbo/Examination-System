<?php include "config.php"; include "function/function.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Examination System</title>
	<link rel="stylesheet" type="text/css" href="<?php echo servername; ?>/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo servername; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo servername; ?>/js/bootstrap.min.js"></script>
</head>
<body >
<?php
if( !isset($_SESSION["userID"])) {
	jsRedirect("index.php");
}
if( isset($_GET["logout"] )) {
	if( $_GET["logout"] == $_SESSION["userID"]) {
		unset($_SESSION["userID"]);
		jsRedirect("index.php");
	}
}
$query = "select * from user where id='" . $_SESSION["userID"] . "'";
$userdata = json_decode(json_encode(getJSONdata($query)), true);
?>
<div class="col-md-offset-3 col-md-6">
	<div class="panel panel-default" style="padding: 30px; margin-top: 50px;">