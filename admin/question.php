<?php 
$link = "question";
include "header.php";  ?>
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
				<?php 
				$data = getJSONdata("select * from exams where auth=" . str($_GET["auth"]) . " and userauth=" . str($_SESSION["adminID"]));
				?>
				<div class="alert alert-info">
					<h3><strong><?php echo $data[0]->title; ?></strong></h3>
					<p>
						<a href="studentselector.php?auth=<?php echo $_GET["auth"]; ?>" class="btn btn-primary pull-right">Select Student.</a>
						<div class="clearfix"></div>
						Exam URL: <a href="/exam/exam.php?url=<?php echo $data[0]->auth; ?>" target="_blank"><?php echo servername . "/exam.php?url=" . $data[0]->auth; ?></a>
					</p>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php 
						$questiontxt = "";
						if( isset($_POST["addquestion"])) {
							$questiontxt = $_POST["question"];
							$isError = false;
							$index = 0;
							$isMany = 0;

							$choicesType = "";

							$correct = $_POST["correct"];
							for ($i=0; $i < count($correct) ; $i++) { 
								# code...
								if($correct[$i] == 0) {
									$index++;
								} else {
									$isMany++;
								}
							}

							if( $isMany > 1 ) {
								$choicesType = "multiple";
							} else {
								$choicesType = "select";
							}

							if( $index == count($correct)) {
								?>
								<div class="form-group">
									<div class="alert alert-danger"><strong>Error! Please Select the possible correct answer.</strong></div>
								</div>
								<?php
							} else {
								$questiontxt = "";
								$exec = dataExecute("insert", "questions", 
									[
									"question" => str($_POST["question"]),
									"examination_url" => str($_GET["auth"])
									], null);
								$id = getID();
								if( $exec ) {
									$choices = $_POST["choices"];
									for ($i=0; $i < count($choices) ; $i++) { 
										# code...
										dataExecute("insert", "answers", 
											[
											"answer" => str($choices[$i]),
											"type" => str($correct[$i]),
											"questionid" => $id,
											"selection_type" => str($choicesType)
											], null);
									}
									?>
									<div class="form-group">
										<div class="alert alert-info"><strong>Success! new Question has been saved.</strong></div>
									</div>
									<?php
								}
							}
						}
						?>
						<form method="post" id="_submit">
							<div class="form-group">
								<textarea placeholder="Enter your Questions" required name="question" class="form-control" rows="5"><?php echo $questiontxt; ?></textarea>
							</div>
							<div class="form-group">
								<a style="margin-left: 5px; margin-bottom: 10px;" href="javascript: void(0)" id="__remove" class="pull-right btn btn-warning btn-xs"><i class="glyphicon glyphicon-minus"></i></a>
								<a href="javascript: void(0)" id="__add" class="pull-right btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i></a>
								<label>Choices</label>
								<div id="_default">
									<div id="_remover">
										<input type="text" required class="form-control" placeholder="Enter Choices" name="choices[]">
										<input type="checkbox" value="1" name="correct[]"> <small>Mark this as correct answer.</small>
									</div>
								</div>
								<div id="_expandable">
									
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Add to Questions" class="btn btn-primary" name="addquestion">
							</div>
							<p id="test">
								
							</p>
						</form>
					</div>
					<div class="col-md-6" id="_modules">
						<?php 
						if( isset($_GET["remove"])) {
							$id = $_GET["remove"];
							$query = "delete a.*, b.* from questions a join answers b on a.id=b.questionid where a.id=" . $id;
							mysqli_query($mysqli, $query);
							?>
							<div class="col-md-12">
								<div class="alert alert-danger alert-dismissable col-md-12">
									<a href="question.php?auth=<?php echo $_GET["auth"]; ?>" class="close">&times;</a>
									<strong>Success. you removed a question.</strong>
								</div>
							</div>
							<?php
						}

						if( isset($_GET["question_remove"] )) {
							dataExecute("delete", "answers", null, $_GET["question_remove"]);
							?>
							<div class="col-md-12">
								<div class="alert alert-danger alert-dismissable col-md-12">
									<a href="question.php?auth=<?php echo $_GET["auth"]; ?>" class="close">&times;</a>
									<strong>Success. you removed one of the choices.</strong>
								</div>
							</div>
							<?php
						}

						if( isset($_POST["save_edit"])) {
							$table = $_POST["__choices"];
							$id = $_POST["__id"];
							$value = str($_POST["_content"]);

							$data = $table == "questions" ? "question" : "answer";

							dataExecute("update", $table, [
								$data => $value
								]
								, $id);
								?>
								<script type="text/javascript">
									alert("Saved!");
									window.location.href = "question.php?auth=<?php echo $_GET["auth"]; ?>";
								</script>
								<?php
						}

						function displayAnswers($questionid) {
							$query = "select * from answers where questionid=" . $questionid;
							$res = getJSONdata($query);

							foreach ($res as $key => $value) {
								# code...
								?>
								<div class="form-group">
									<a href="#" id="_dataedit" data-toggle="modal" data-target="#popup" data-choices="answers" data-id="<?php echo $value->id; ?>" data-value="<?php echo $value->answer; ?>"><i class="pull-right glyphicon glyphicon-pencil"></i></a>
									<a href="question.php?auth=<?php echo $_GET["auth"]; ?>&question_remove=<?php echo $value->id; ?>" class="pull-right"><i style="margin-right: 10px;" class="glyphicon glyphicon-trash"></i></a>
									<input name="_choose" type="<?php echo $value->selection_type == "multiple" ? "checkbox" : "radio" ?>" value="<?php echo $value->id; ?>"> <?php echo $value->answer; ?> <?php echo $value->type == 1 ? "<span style=\"color: " . admin . ";\">(Correct Answer)</span>" : ""; ?>
								</div>
								<?php
							}
						}


						function correctAnswers( $exam_url ) {
							$ret = 0;
							$q = "select a.*, b.*, b.type as correctanswer from questions a join answers b on b.questionid = a.id where a.examination_url=" . str($exam_url);
							$res = getJSONdata($q);
							foreach ($res as $key => $value) {
								# code...
								if($value->correctanswer == 1) {
									$ret++;
								}
							}
							return $ret;
						}

						$qq = "select * from questions where examination_url=" . str($_GET["auth"]);
						$items = checkRows($qq);
						?>
						<div class="col-md-12">
							<h1>Items: <?php echo $items; ?></h1>
							<p>
								<strong>Number of correct answers: <?php echo correctAnswers($_GET["auth"]); ?></strong>
							</p>
							<div class="form-group" style="margin-bottom: 20px;">
								<div class="col-md-4" style="padding: 0;">
									<label>Enter Passing Score</label>
									<input type="number" id="__passing" value="<?php echo $data[0]->passing; ?>" class="form-control" name="">
									<p>
										<strong style="color: <?php echo admin; ?>">Passing Grade: <span id="__passing_val"><?php echo $data[0]->passing; ?></span></strong>
									</p>
									<br>
								</div>
							</div>
						</div>
						<div style="padding: 10px;"></div>
						<?php
						$selectQuestions = getJSONdata($qq);
						foreach ($selectQuestions as $key => $value) {
							# code...
							?>
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" id="__modal_head">
										<a href="#" id="_dataedit" data-toggle="modal" data-target="#popup" data-choices="questions" data-id="<?php echo $value->id; ?>" data-value="<?php echo $value->question; ?>"><i class="pull-right glyphicon glyphicon-pencil"></i></a>
										<a href="question.php?auth=<?php echo $_GET["auth"]; ?>&remove=<?php echo $value->id; ?>" class="pull-right"><i style="margin-right: 10px;" class="glyphicon glyphicon-trash"></i></a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" role="dialog" id="popup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<a href="javascript:void(0);" class="close" data-dismiss="modal">&times;</a>
				<form method="post">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" id="__choices" name="__choices">
							<input type="hidden" id="__id" name="__id">
							<div class="form-group">
								<textarea id="_content" class="form-control" value="" rows="5" name="_content" required=""></textarea>
							</div>
							<div class="form-group">
								<input type="submit" value="Save Changes" class="btn btn-primary" name="save_edit">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 
if( isset($_POST["ajax"] )) {
	dataExecute("update", "exams", 
		[
		"passing" => $_POST["val"]
		], $_POST["examid"]);
	die();
}
?>
<script type="text/javascript">
	$(document).ready( function() {
		$("#__add").click( function() {
			var html = $("#_default").html();
			$("#_expandable").append(html);
		});
		$("#__remove").click( function() {
			$("#_expandable").children().last().remove();
		});

		$("#_submit").submit( function() {
			$("#_submit input[type=checkbox]:not(:checked)").each( function() {
				$(this).attr("checked", true).val(0);
			});
		});

		$("#_modules").delegate("#_dataedit", "click", function() {

			var choicesType = $(this).attr("data-choices");
			var id = $(this).attr("data-id");
			var content = $(this).attr("data-value");

			$("#__id").val(id);
			$("#__choices").val(choicesType);

			if(choicesType == "questions") {
				$("#_content").val($(this).parent().find("#__question_").text());
			} else {
				$("#_content").val(content);
			}

		});

		$("#__passing").on("keyup", function() {
			var pass = parseInt($(this).val() <= 0 ? "<?php echo correctAnswers($_GET["auth"]); ?>" : $(this).val());
			$("#__passing_val").text(pass);

			if(pass > <?php echo correctAnswers($_GET["auth"]); ?>) {
				alert("Invalid Value");
				$("#__passing_val").text("<?php echo correctAnswers($_GET["auth"]); ?>");
				$(this).val(<?php echo correctAnswers($_GET["auth"]); ?>);
			} else {
				$.ajax({
					url: "question.php?auth=<?php echo $_GET["auth"]; ?>",
					type: "post",
					data: {
						ajax: "1",
						val: pass,
						examid: <?php echo $data[0]->id; ?>
					},
					success: function(data) {
					}
				});
			}

		});
	});
</script>
<?php include "footer.php"; ?>