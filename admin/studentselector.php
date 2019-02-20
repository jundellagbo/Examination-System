<?php 
include "../config.php";
include "../function/function.php";

if( isset($_POST["select"])) {
	$user = $_POST["userid"];
	$teacher = $_POST["teacher"];
	$examurl = $_POST["examurl"];

	dataExecute("insert", "examinee", 
		[
			"userid" => $user,
			"teacher" => str($teacher),
			"examurl" => str($examurl)
		], null);

	die();
}

if( isset($_POST["unchec"])) {
	$user = $_POST["userid"];
	$teacher = $_POST["teacher"];
	$examurl = $_POST["examurl"];
	
	$query = "delete from examinee where userid=" . $user;
	mysqli_query($mysqli, $query);	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Selector</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo servername; ?>/admin/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo servername; ?>/admin/css/styles.css">
	<script type="text/javascript" src="<?php echo servername; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo servername; ?>/js/bootstrap.min.js"></script>

</head>
<style type="text/css">
body{
			background-image: url('images/a.jpg');
			background-size: cover;
}
</style>

<body>
<div class="container" style="margin-top: 50px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<a href="question.php?auth=<?php echo $_GET["auth"]; ?>" class="pull-right">< Back</a>
				<h3>Student Selector</h3>
				<div class="clearfix">
					<hr style="border: 1px solid #ccc;">
				</div>
				<div class="form-group">
					<form method="post">
					<input type="text" placeholder="Search Student" id="_search" name="__search">
					<select id="_department" name="__department">
						<?php 
						$q = "select * from department where userauth=" . str($_SESSION["adminID"]);
						$res = getJSONdata($q);
						foreach ($res as $key => $value) {
							# code...
							?>
							<option value="<?php echo $value->department; ?>"><?php echo $value->department; ?></option>
							<?php
						}
						?>
					</select>
					<input type="submit" name="__searchme" value="Search">
					</form>
				</div>
				<div class="form-group">
					<table class="table table-responsive">
						<thead>
							<tr>
								<th></th>
								<th>Names <small>(Lastname, Firstname)</small></th>
								<th>Department</th>
								<th>Access ID</th>
							</tr>
						</thead>
						<tbody id="searchresult">
							<?php 

								function isChecked( $user ) {

									$q = "select * from examinee a where a.userid=" . $user . " and a.examurl=" . str($_GET["auth"]);
									return checkRows($q) == 1? "checked" : "";
								}

								function data($search, $department) {
									$query = "select a.*, b.*, a.id as useridd, a.auth as examurl from user a join department b on a.departmentid=b.id where a.firstname like '%" . $search . "%' or lastname like '%" . $search . "%' or accessid like '%" . $search . "%' or department like '%" . $search . "%'";
									$res = getJSONdata($query);
									foreach ($res as $key => $value) {
										# code...
										?>
										<tr>
											<td><input id="__select" type="checkbox" value="<?php echo $value->useridd; ?>" <?php echo isChecked($value->useridd); ?>></td>
											<td><?php echo $value->lastname; ?>, <?php echo $value->firstname; ?></td>
											<td><?php echo $value->department; ?></td>
											<td><?php echo $value->accessid; ?></td>
										</tr>
										<?php
									}
								}

								if( isset($_POST["__searchme"])) {
									$key = $_POST["__search"];
									$department = $_POST["__department"];
									data($key, $department);		
								} else {
									data(null, null);
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function() {

		$("#searchresult").delegate("#__select", "change", function() {

			if($(this).is(":checked")) {

				$.ajax({

					url: "studentselector.php?auth=<?php echo $_GET["auth"]; ?>",
					type: "post",
					data: {
						select: 1,
						examurl: "<?php echo $_GET["auth"] ?>",
						teacher: "<?php echo $_SESSION["adminID"]; ?>",
						userid: $(this).val()
					},
					success: function(data) { }
				});

			} else {
				$.ajax({

					url: "studentselector.php?auth=<?php echo $_GET["auth"]; ?>",
					type: "post",
					data: {
						unchec: 1,
						examurl: "<?php echo $_GET["auth"] ?>",
						teacher: "<?php echo $_SESSION["adminID"]; ?>",
						userid: $(this).val()
					},
					success: function(data) { }
				});

			}

		});

	});
</script>
</body>
</html>