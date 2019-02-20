<?php include "header.php"; ?>
<a href="?logout=<?php echo $_SESSION["userID"]; ?>" class="pull-right btn btn-primary btn-xs">Logout</a>
<h3>Welcome <?php echo $userdata[0]["firstname"]; ?></h3>
<style type="text/css">
	.__opacity {
		opacity: 0.7;
	}
</style>
<div style="padding: 50px 0;">
	<?php 

	function isRemarked( $url ) {

		$query = "select * from remarks where exam_url=" . str($url) . " and userid=" . $_SESSION["userID"];
		if(checkRows( $query )) {
			return true;
		}
	}

	function loadExams( $url ) {

		$exams = "select * from exams where auth=" . str($url);
		$data = getJSONdata($exams);
		foreach ($data as $key => $value) {
			# code...
			?>
			<div style="margin: 10px;" class="col-md-12 alert <?php echo isRemarked($url) ? "alert-success __opacity" : "alert-info"; ?>">
				<h4><?php echo $value->title; ?> - ( <?php echo $value->semester; ?> )</h4>
				<?php 
				if( isRemarked($url) ) {
					$getRemark = "select score, remarks from remarks where exam_url=" . str($url) . " and userid=" . $_SESSION["userID"];
					$remarkdata = getJSONdata($getRemark);
					?>
					<p>
						Score: <?php echo $remarkdata[0]->score; ?>
					</p>
					<p style="color: <?php echo $remarkdata[0]->remarks == "Failed" ? "red" : user; ?>">
						Remarks: <?php echo $remarkdata[0]->remarks; ?>
					</p>
					<?php
				} else {
					?>
					<p style="font-size: 12px;">
						url: 
						<a href="exam.php?url=<?php echo $value->auth; ?>"><strong><?php echo servername . "/exam.php?url=" . $value->auth; ?></strong></a>
					</p>
					<p>
						Passing Score: <strong style="color: <?php echo user; ?>"><?php echo $value->passing; ?></strong>
					</p>
					<?php
				}
				?>
			</div>
			<?php
		}
	}

	$examinee = "select * from examinee where userid=" . $_SESSION["userID"];
	if(checkRows($examinee) > 0) {
		$data = getJSONdata($examinee);
		foreach ($data as $key => $value) {
			# code...
			loadExams( $value->examurl );
		}
	} else {
		?>
		<div class="alert alert-warning">
			<strong>There is no examination found.</strong>
		</div>
		<?php
	}
	?>
	<div class="clearfix"></div>
</div>
<style type="text/css">
body{
			background-image: url('a.jpg');
			background-size: cover;
}
</style>
<?php include "footer.php"; ?>