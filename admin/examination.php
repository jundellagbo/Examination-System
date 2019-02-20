<?php 
$link = "examination";
include "header.php";
if( !empty($_GET["remove"])) {
	$query = "select * from exams where id=" . $_GET["remove"];
	$data = json_decode(json_encode(getJSONdata($query), true) );
	$examinee = "delete from examinee where examurl=" . str($data[0]->auth);;
	mysqli_query($mysqli, $examinee);
	dataExecute("delete", "exams", null, $_GET["remove"]);
	jsRedirect("examination.php?show=true");
}
?>
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
				<div class="row">
					<div class="col-md-12">
						<h3>Examination</h3>
						<?php 
						if(isset($_GET["show"])) {
							?>
							<a class="btn btn-danger pull-right" href="examination.php">Add Exam</a>
							<?php
						} else {
							?>
							<a class="btn btn-primary pull-right" href="?show=true">Show Exams</a>
							<?php
						}
						?>
					</div>
					<div class="col-md-10">
						<?php 
						if(!isset($_GET["show"])) {
							if( isset($_POST["add"])) {
								dataExecute("insert", "exams", 
									[
									"title" => str($_POST["examtitle"]),
									"auth" => str(generateApi()),
									"userauth" => str($_SESSION["adminID"]),
									"semester" => str($_POST["semester"])
									], null);
									?>
									<div class="form-group">
										<div class="alert alert-info"><strong>Success. New Examination has been saved. <a href="?show=true">Click here</a> to check your new added examination</strong></div>
									</div>
									<?php
							}
							?>
							<form method="post">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Enter Examination Title" name="examtitle" required>
								</div>
								<div class="form-group">
									<select class="form-control" name="semester">
										<option value="1st Semester">1st Semester</option>
										<option value="2nd Semester">2nd Semester</option>
									</select>
								</div>
								<div class="form-group">
									<input type="submit" value="add" class="btn btn-primary" name="add">
								</div>
							</form>
							<?php
						}
						else {
							$exams = file_get_contents(servername . "/admin/examapi.php?admin=" . $_SESSION["adminID"]);
							$data = json_decode($exams, true);
							?>
							<div class="form-group">
								<table class="table table-responsive" id="examwrap">
									<thead>
										<tr>
											<th>Examination Name</th>
											<th>Semester</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										foreach ($data as $key => $value) {
											# code...
											?>
											<tr>
												<td><strong><?php echo $value["title"]; ?></strong></td>
												<td><strong><?php echo $value["semester"]; ?></strong></td>
												<td><a href="question.php?auth=<?php echo $value["auth"]; ?>" class="btn-xs btn btn-primary">View Examination</a> <a href="?show=true&remove=<?php echo $value["id"]; ?>" class="btn-xs btn btn-danger">Remove Exam</a> <a class="btn btn-warning btn-xs" data-id="<?php echo $value["id"]; ?>" exam-title="<?php echo $value["title"]; ?>" href="#" id="change_title" data-toggle="modal" data-target="#popup">Change Examination Title</a></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
if( isset($_POST["savechanges"])) {
	dataExecute("update", "exams", 
		[
		"title" => str($_POST["newtitle"])
		], $_POST["id"]);
	?>
	<script type="text/javascript">
		alert("Saved!");
		window.location.href = "examination.php?show=true";
	</script>
	<?php
}
?>
<div class="modal fade" role="dialog" id="popup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<a href="javascript:void(0);" class="close" data-dismiss="modal">&times;</a>
				<form method="post">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" id="examauthkey" name="id">
							<div class="form-group">
								<input type="text" id="_examtitle" class="form-control" value="" name="newtitle" required="">
							</div>
							<div class="form-group">
								<input type="submit" value="Save Changes" class="btn btn-primary" name="savechanges">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( function() {
		$("#examwrap").delegate("#change_title", "click", function() {
			$("#examauthkey").val($(this).attr("data-id"));
			$("#_examtitle").val($(this).attr("exam-title"));
		});
	});
</script>
<?php include "footer.php"; ?>