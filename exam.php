<?php include "header.php"; 
$returnUser = "select * from remarks where exam_url=" . str($_GET["url"]) . " and userid=" . $_SESSION["userID"];
if(checkRows($returnUser) > 0) {
	jsRedirect("dashboard.php");
}

$getdatRows = "select * from questions where examination_url=" . str($_GET["url"]);
$checkRows = checkRows($getdatRows);
$exam = "select * from exams where auth=" . str($_GET["url"]);
$examdata = getJSONdata($exam);
if( !isset($_SESSION["storedCounter"])) {
	$_SESSION["storedCounter"] = 1;
}
?>
<a href="<?php echo servername; ?>/dashboard.php">Home</a>
<a href="?logout=<?php echo $_SESSION["userID"]; ?>" class="pull-right btn btn-primary btn-xs">Logout</a>
<h3>Welcome <?php echo $userdata[0]["firstname"]; ?></h3>
<br>
<h4 style="text-align: center; color: <?php echo user; ?>"><?php echo $examdata[0]->title; ?></h4>
<p style="text-align: center;">
	<small>Note: ( Please dont forget to fillout those checkbox or radiobuttons. )</small>
</p>
<?php 

function isCorrect( $answerid ) {
	$qq = "select * from answers where id=" . $answerid . " and type=1";
	$check = checkRows($qq);
	if($check > 0) {
		return true;
	}
}

if( isset($_POST["__next"] )) {

	for( $i = 0; $i < count($_POST["_choose"]); $i++ ) {
		$_SESSION["storedAnswers"][] = $_POST["_choose"][$i];
	}

	$_SESSION["storedCounter"]++;

	$correctAnswer = 0;
	if($_SESSION["storedCounter"] > $checkRows) {
		
		for( $i = 0; $i < count($_SESSION["storedAnswers"]); $i++) {
			if( isCorrect( $_SESSION["storedAnswers"][$i] ) ) {
				$correctAnswer++;
			}
		}

		$remarks = $correctAnswer >= $examdata[0]->passing ? "Passed" : "Failed";

		dataExecute("insert", "remarks", [
			"exam_url" => str($_GET["url"]),
			"userid" => $_SESSION["userID"],
			"score" => $correctAnswer > 0 ? $correctAnswer : 0,
			"remarks" => str($remarks),
			"date_taken" => str(date('d/m/Y h:i:sa'))
		], null);

		unset($_SESSION["storedAnswers"]);
		unset($_SESSION["storedCounter"]);

		jsRedirect("dashboard.php");
	}
}

?>

<div style="padding: 50px 0;">
<form method="post" id="form-exam-complete">
	<div class="alert alert-danger hidden">
		<strong>This field is required</strong>
	</div>
<?php

function displayAnswers($questionid) {
	$query = "select * from answers where questionid=" . $questionid;
	$res = getJSONdata($query);
	?>
	<div id="required-checked">
	<?php
	foreach ($res as $key => $value) {
		# code...
		?>
		<div class="form-group">
			<input name="_choose[]" type="<?php echo $value->selection_type == "multiple" ? "checkbox" : "radio" ?>" value="<?php echo $value->id; ?>"> <?php echo $value->answer; ?>
		</div>
		<?php
	}
	?>
	</div>
	<?php
}
$qq = "select * from questions where examination_url=" . str($_GET["url"]) . " limit " . intval($_SESSION["storedCounter"] - 1) . ",1";
$selectQuestions = getJSONdata($qq);
foreach ($selectQuestions as $key => $value) {
	# code...
	?>
	<div class="form-group">
		<div class="panel panel-default">
			<div class="panel-heading" id="__modal_head">
				<div id="__question_"><?php echo nl2br($value->question); ?></div>
			</div>
			<div class="panel-body">
				<?php displayAnswers( $value->id ); ?>
			</div>
		</div>
	</div>
	<?php
}
?>
<div class="form-group text-center">
	<input type="submit" class="btn btn-info" value="<?php echo $_SESSION["storedCounter"] == $checkRows ? "Submit Exam" : "Next"; ?>" name="__next">
</div>
</form>
</div>
<script type="text/javascript">
	$( document ).ready( function() {
		$("#form-exam-complete").submit( function() {
			var index = 0;
			$.each($("#required-checked input"), function( key, value ) {
				if($(this).is(":checked")) {
					index++;
				}
			});

			if( index == 0 ) {
				$(".alert").removeClass("hidden");
				return false;
			}

		});
	});
</script>
<style type="text/css">
body{
			background-image: url('a2.jpg');
			background-size: cover;
}
</style>
<body></body>
<?php include "footer.php"; ?>