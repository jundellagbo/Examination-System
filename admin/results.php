<?php 
$link = "results";
include "header.php";?>
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
				<h3>Search Results</h3>
				<div class="row">
				<?php 
				$key = "";
				$auth = $_SESSION["adminID"];
				if( isset($_POST["find"])) {
					$key = $_POST["search"];
				}
				$query = "select a.id,a.firstname,lastname,accessid,auth,admin,b.id,b.department,a.accessid from user a join department b on b.id=a.departmentid where admin=" . str($auth) . " and (firstname like '%" . $key . "%' or lastname like '%" . $key . "%' or accessid like '%" . $key . "%' or department like '%" . $key . "%');";

				$data = getJSONdata($query);
				$index = 0;
				foreach ($data as $key => $value) {
					# code...
					?>
					<div class="col-md-12 form-group">
						<h5><?php echo $value->firstname . " " . $value->lastname; ?> <strong>(<?php echo $value->accessid; ?>)</strong> - <i><?php echo $value->department; ?></i></h5>
						<hr>
					</div>
					<?php
					$index++;
				}
				if($index == 0) {
					?>
					<div class="form-group col-md-12">
						<div class="alert alert-danger"><strong>Oops. No Results Found.</strong></div>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>