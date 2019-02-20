<?php 
$link = "department";
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
				<h3>Department</h3>
				<small>Enter Department Name including its category example: BSIT 1A, BSIT 2B etc.</small>
				<div class="row">
					<div class="col-md-6">
						<?php 
						if( isset($_POST["add"] )) {
							$check = checkRows("select * from department where department=" . str($_POST["department"]) . " and userauth=" . str($_SESSION["adminID"]));
							if($check == 1) {
								?>
								<div class="form-group">
									<div class="alert alert-danger">Oops! you have already added this department.</div>
								</div>
								<?php
							} else {
							dataExecute("insert", "department", 
								[
								"department" => str($_POST["department"]),
								"userauth" => str($_SESSION["adminID"])
								], null);
								?>
								<div class="form-group">
									<div class="alert alert-info"><strong>Success! You have added a Department.</strong></div>
								</div>
								<?php
							}
						}
						?>
						<form method="post">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter Department Name" required name="department">
							</div>
							<div class="form-group">
								<input type="submit" value="Add Department" class="btn btn-primary" name="add">
							</div>
						</form>
						<p>
							<small>Note: There is no Deletion of This Field. (it will affected to those data who are in this department)</small>
						</p>
						<table class="table table-responsive" id="departmentwrap">
							<thead>
								<tr>
									<th>Department</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$data = getJSONdata("select * from department where userauth=" . str($_SESSION["adminID"]));
								foreach ($data as $key => $value) {
									# code...
									?>
									<tr>
										<td><?php echo $value->department; ?></td>
										<td><a href="#" id="change_department" data-id="<?php echo $value->id; ?>" data-value="<?php echo $value->department; ?>" data-toggle="modal" data-target="#popup"><i class="glyphicon glyphicon-pencil"></i></a></td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
if( isset($_POST["savechanges"])) {
	dataExecute("update", "department", 
		[
		"department" => str($_POST["department"])
		], $_POST["id"]);
	?>
	<script type="text/javascript">
		alert("Saved!");
		window.location.href = "department.php";
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
							<input type="hidden" id="_id" name="id">
							<div class="form-group">
								<input type="text" id="_department" class="form-control" value="" name="department" required="">
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
		$("#departmentwrap").delegate("#change_department", "click", function() {
			$("#_id").val($(this).attr("data-id"));
			$("#_department").val($(this).attr("data-value"));
		});
	});
</script>
<?php include "footer.php"; ?>