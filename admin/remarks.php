<?php 
$link = "remarks";
include "header.php";
if( !empty( $_GET["retake"] ) ) {
	dataExecute("delete", "remarks", null, $_GET["retake"]);
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
	<style type="text/css">
		.__failure {
			color: red;
    		font-weight: 900;
		}
	</style>
	<div class="row">
		<div class="col-md-12">
			<div class="content-box">
				<div class="form-group">
					<div class="col-sm-4">
						<form method="post">
							<input type="text" name="__keyword" placeholder="Search">
							<input type="submit" name="_search" value="Search">
						</form>
					</div>
					<div class="pull-right">
						<form method="post">
							<select name="filter">
								<option value="">Select to Filter</option>
								<option value="Passed">Passed</option>
								<option value="Failed">Failed</option>
							</select>
							<input type="submit" value="Filter" name="_getFilter">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
				<table class="table table-responsive">
					<thead>
						<tr>
							<th></th>
							<th>Lastname, Firstname</th>
							<th>Exam Title</th>
							<th>Date Taken</th>
							<th>Score</th>
							<th>Remarks</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						function remarksDataKey( $key ) {
							$query = "select a.*, c.*, b.*, b.id as examidd, c.id as useridd, a.id as remarkid from remarks a join exams b on b.auth=a.exam_url join user c on c.id=a.userid where firstname like '%" . $key . "%' or lastname like '%" . $key . "%';";
							$getdata = getJSONdata($query);
							foreach ($getdata as $key => $value) {
								# code...
								?>
								<tr>
									<td><?php echo $value->examidd; ?></td>
									<td style="text-transform: capitalize;"><?php echo $value->lastname . ", " . $value->firstname; ?></td>
									<td><?php echo $value->title . " - " . "( " . $value->semester . " )"; ?></td>
									<td><?php echo $value->date_taken; ?></td>
									<td><?php echo $value->score; ?></td>	
									<td><span class="<?php echo $value->remarks == "Failed" ? "__failure" : ""; ?>"><?php echo $value->remarks; ?></span></td>
									<td>
									<?php 
									if( $value->remarks == "Failed" ) {
										?>
										<a href="?retake=<?php echo $value->remarkid;?>" class="btn btn-primary btn-xs">Retake Exam</a>
										<?php
									}	
									?>
									</td>
								</tr>
								<?php
							}
						}

						function remarksDataFilter( $filter ) {
							$clause = "";
							if(!empty($filter)) {
								$clause = " where remarks=" . str($filter);
							}
							$query = "select a.*, c.*, b.*, b.id as examidd, c.id as useridd, a.id as remarkid from remarks a join exams b on b.auth=a.exam_url join user c on c.id=a.userid" . $clause;
							$getdata = getJSONdata($query);
							foreach ($getdata as $key => $value) {
								# code...
								?>
								<tr>
									<td><?php echo $value->examidd; ?></td>
									<td style="text-transform: capitalize;"><?php echo $value->lastname . ", " . $value->firstname; ?></td>
									<td><?php echo $value->title . " - " . "( " . $value->semester . " )"; ?></td>
									<td><?php echo $value->date_taken; ?></td>
									<td><?php echo $value->score; ?></td>	
									<td><span class="<?php echo $value->remarks == "Failed" ? "__failure" : ""; ?>"><?php echo $value->remarks; ?></span></td>
									<td>
									<?php 
									if( $value->remarks == "Failed" ) {
										?>
										<a href="?retake=<?php echo $value->remarkid;?>" class="btn btn-primary btn-xs">Retake Exam</a>
										<?php
									}	
									?>
									</td>
								</tr>
								<?php
							}
						}
						if( isset($_POST["_search"])) {
							$key = $_POST["__keyword"];
							remarksDataKey($key);

						} else if(isset($_POST["_getFilter"])) {
							$filter = $_POST["filter"];
							remarksDataFilter($filter);
						} else {
							remarksDataKey(null);
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>