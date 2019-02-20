<?php 
$link = "users";
include "header.php";
if(!empty($_GET["remove"])) {
$id = $_GET["remove"];
dataExecute("delete", "user", null, $id);
}
?>
<style type="text/css">
body{
			background-image: url('images/a2.jpg');
			background-size: cover;
}
</style>
<body></body>
<div class="col-md-10">
	<div class="row">
		<div class="col-md-12">
			<div class="content-box">
				<div class="row">
					<div class="col-md-12">
						<h2>Users</h2>
						<small>Note: This user is one of your candidate.</small>
						<?php 
						if( isset($_GET["showusers"])) {
							?>
							<a class="btn btn-warning pull-right" href="users.php">Add User</a>
							<?php
						} else {
							?>
							<a class="btn btn-info pull-right" href="?showusers=true">Show Users</a>
							<?php
						}
						?>
					</div>
					<div class="col-md-6">
						<?php 
						if( isset($_GET["showusers"])) {
							$userdata = file_get_contents(servername . "/admin/userapi.php?admin=" . $_SESSION["adminID"]);
							$datas = json_decode($userdata, true);
							?>
							<p>
								These are your students lists.
							</p>
							<table class="table table-bordered">
							<thead>
								<tr>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>UserID</th>
									<th>Department</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach($datas as $key => $value) {
								# code...
								?>
								<tr>
									<td><?php echo $value["firstname"]; ?></td>
									<td><?php echo $value["lastname"]; ?></td>
									<td><?php echo $value["accessid"]; ?></td>
									<td><?php echo $value["department"]; ?></td>
									<td><a href="?showusers=true&remove=<?php echo $value["useridd"]; ?>">Remove <i class="glyphicon glyphicon-remove"></i></a></td>
								</tr>
								<?php
							}
							?>
							</tbody>
							</table>
							<?php
						} else {
							$fname ="";
							$lname ="";
							$pass ="";
							$cpass ="";
							$id ="";
							if( isset($_POST["add"])) {
								$fname = $_POST["fname"];
								$lname = $_POST["lname"];
								$id = $_POST["accessid"];
								if($_POST["pass"] != $_POST["cpass"]) {
									?>
									<div class="form-group">
										<div class="alert alert-danger"><strong>Password Doesnt Match.</strong></div>
									</div>
									<?php
								} else {
									$check = checkRows("select * from user where accessid='" . $_POST["accessid"] . "' and password='" . md5($_POST["pass"]) . "';");
									if( $check == 1 ) {
										?>
										<div class="form-group">
											<div class="alert alert-danger"><strong>We did not recognize this account.</strong></div>
										</div>
										<?php
									} else {
										dataExecute("insert", "user", [
											"firstname" => str($_POST["fname"]),
											"lastname" => str($_POST["lname"]),
											"password" => str(md5($_POST["pass"])),
											"accessid" => str($_POST["accessid"]),
											"auth" => str(generateApi()),
											"admin" => str($_SESSION["adminID"]),
											"departmentid" => $_POST["department"]
											], null);
										$fname = "";
										$lname = "";
										$id = "";
											?>
											<div class="form-group">
												<div class="alert alert-info"><strong>New user has been added.</strong></div>
											</div>
											<?php
									}
								}
							}
							?>
							<form method="post">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $fname; ?>" placeholder="Enter Firstname" name="fname" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Enter Lastname" name="lname" value="<?php echo $lname; ?>" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $id; ?>" placeholder="Enter Access ID" name="accessid" required>
								</div>
								<div class="form-group">
									<select class="form-control" name="department">
										<option>Select Department</option>
										<?php 
										$department = getJSONdata("select * from department where userauth='" . $_SESSION["adminID"] . "'");
										foreach ($department as $key => $value) {
											# code...
											?>
											<option value="<?php echo $value->id; ?>"><?php echo $value->department; ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Enter Password" name="pass" value="<?php echo $pass; ?>" required>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Confirm Password" name="cpass" value="<?php echo $cpass; ?>" required>
								</div>
								<div class="form-group">
									<input type="submit" value="Add User" class="btn btn-primary" name="add">
								</div>
							</form>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>