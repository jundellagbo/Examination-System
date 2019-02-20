<?php 
$link = "account";
include "header.php"; ?>
<style type="text/css">
body{
			background-image: url('images/a.jpg');
			background-size: cover;
}
</style>
<body></body>
<div class="col-md-10">
	<div class="row">
		<div class="col-md-12">
			<div class="content-box">
				<h3>My Account</h3>
				<div class="row">
					<div class="col-md-6">
						<?php
						if( isset($_POST["change"] )) {
							if( $_POST["pass"] != $_POST["cpass"] ) {
								?>
								<div class="form-group">
									<div class="alert alert-danger"><strong>Password Doesnt Match.</strong></div>
								</div>
								<?php
							} else {
								dataExecute("update", "admin", 
								[
								"firstname" => str($_POST["fname"]),
								"userid"	=> str($_POST["userid"]),
								"password"	=> str(md5($_POST["pass"]))
								], $userdata[0]["id"]);
								?>
								<div class="form-group">
									<div class="alert alert-info"><strong>Changes has been made.</strong></div>
								</div>
								<?php
							}
						}
						?>
						<form method="post">
							<div class="form-group">
								<input type="text" placeholder="Enter your Firstname" value="<?php echo $userdata[0]["firstname"]; ?>" name="fname" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="text" value="<?php echo $userdata[0]["userid"]; ?>" placeholder="User ID" name="userid" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="password" placeholder="Password" name="pass" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="password" placeholder="Confirm Password" name="cpass" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="submit" value="Make Changes" name="change" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>