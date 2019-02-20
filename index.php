<?php include "config.php"; include "function/function.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Examination System</title>
	<link rel="stylesheet" type="text/css" href="<?php echo servername; ?>/css/bootstrap.min.css">
	<style type="text/css">
		body {
			height: 100%;
			background-image: url('a.jpg');
			background-size: cover;
			margin-top: 100px;
		}
	</style>
	<script type="text/javascript" src="<?php echo servername; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo servername; ?>/js/bootstrap.min.js"></script>
</head>
<body >
<?php
if( isset($_SESSION["userID"])) {
	jsRedirect("dashboard.php");
}
?>
<div class="col-sm-offset-4 col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Examination System</h3>
		</div>
		<div class="panel-body">
			<?php 
				$id = "";
				if(isset($_POST["access"])) {
					$id = $_POST["id"];
					$query = "select * from user where accessid='" . $_POST["id"] . "' and password='" . md5($_POST["password"]) . "'";
					$exists = checkRows($query);
					if( $exists == 0 ) {
						?>
						<div class="form-group">
						  <div class="alert alert-danger"><strong>Invalid ID Number or Password</strong></div>
						</div>
						<?php
					}
					else {
						foreach (getJSONdata($query) as $key => $value) {
							# code...
							$_SESSION["userID"] = $value->id;
						}
						jsRedirect("dashboard.php");
					}
				}
			?>
			<form autocomplete="off" method="post">
				<div class="form-group">
					<label>Enter your Unique ID number</label>
					<input type="text" name="id" class="form-control">
				</div>
				<div class="form-group">
					<label>Enter your password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-info" name="access">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>