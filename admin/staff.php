<?php 
$link = "admin";
include "header.php"; ?>
<div class="col-md-10">
	<div class="row">
		<div class="col-md-12">
			<div class="content-box">
				<div class="row">
					<div class="col-md-6">
						<h3>Welcome to Staff</h3>
						<?php 
						$firstname = "";
						$userid = "";
						$password = "";
						$cpassword = "";
						if( isset($_POST["add"] )) {
							$firstname = $_POST["firstname"];
							$userid = $_POST["userid"];
							if( $_POST["cpassword"] != $_POST["password"] ) {
								?>
								<div class="form-group">
									<div class="alert alert-danger"><strong>Password Doesnt Match.</strong></div>
								</div>
								<?php
							} else {
								$check = checkRows("select * from admin where userid='" . $_POST["userid"] . "' and password='" . md5($_POST["password"]) . "';");
								if( $check == 1 ) {
									?>
									<div class="form-group">
										<div class="alert alert-danger"><strong>We did not recognize this account.</strong></div>
									</div>
									<?php
								} else {
									dataExecute("insert", "admin", [
										"firstname" => str($_POST["firstname"]),
										"userid" => str($_POST["userid"]),
										"password" => str(md5($_POST["password"])),
										"auth" => str(generateApi())
										], null);
									$firstname = "";
									$userid = "";
										?>
										<div class="form-group">
											<div class="alert alert-info"><strong>New admin has been added.</strong></div>
										</div>
										<?php
								}
							}
						}
						?>
						<form method="post">
							<div class="form-group">
								<input type="text" placeholder="Enter Firstname" value="<?php echo $firstname; ?>" name="firstname" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="text" placeholder="userID" value="<?php echo $userid; ?>" class="form-control" name="userid" required>
							</div>
							<div class="form-group">
								<input type="password" placeholder="password" value="<?php echo $password; ?>" class="form-control" name="password" required>
							</div>
							<div class="form-group">
								<input type="password" value="<?php echo $cpassword; ?>" placeholder="Confirm Password" class="form-control" name="cpassword" required>
							</div>
							<div class="form-group">
								<input type="submit" value="Add Staff" name="add" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>