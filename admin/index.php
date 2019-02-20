<?php 
include "../config.php";
include "../function/function.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="<?php echo servername; ?>/css/bootstrap.min.css">
	<style type="text/css">
		body {
			height: 100%;
			background-image: url('images/a.jpg');
			background-size: cover;
			margin-top: 100px;
		}
	</style>
</head>
<body >
<?php 
if(isset($_SESSION["adminID"])) {
	jsRedirect("dashboard.php");
}
?>
<div class="col-sm-offset-4 col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Administrator</h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" method="post">
				<?php 
				$id = "";
				if(isset($_POST["access"])) {
					$id = $_POST["id"];
					$query = "select * from admin where userid='" . $_POST["id"] . "' and password='" . md5($_POST["password"]) . "'";
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
							$_SESSION["adminID"] = $value->auth;
						}
						jsRedirect("dashboard.php");
					}
				}
				?>
				<div class="form-group">
					<label>ID Number</label>
					<input type="text" value="<?php echo $id; ?>" name="id" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-info" name="access">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo servername; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo servername; ?>/js/bootstrap.min.js"></script>
</body>
</html>