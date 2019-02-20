<?php
$lastinsertid = 0;
function dataExecute( $execution, $table, $dataarr = array(), $id ) {
	$isExecuted = false;
	global $mysqli;
	global $lastinsertid;
	switch ($execution) {
		case 'insert':
			# code...
		$columns = "";
		$data = "";
		foreach ($dataarr as $key => $value) {
			# code...
			$columns .= "`" . $key . "`,";
			$data .= $value . ",";
		}
		$sql = $execution . " into " . $table . "(" . rtrim($columns, ",") . ") values(" . rtrim($data, ",") . ")";
		if(mysqli_query($mysqli, $sql)) {
			$isExecuted = true;
		}
		$lastinsertid = mysqli_insert_id($mysqli);
		break;

		case 'delete':
		$sql = "delete from " . $table . " where id=" . $id;
		if(mysqli_query($mysqli, $sql)) {
			$isExecuted = true;
		}
		break;

		case 'deleteAll':
		$sql = "delete from " . $table;
		if(mysqli_query($mysqli, $sql)) {
			$isExecuted = true;
		}
		break;

		case 'update':
		$setter = "";
		foreach ($dataarr as $key => $value) {
			# code...
			$setter .= $key . "=" . $value . ",";
		}
		$sql = $execution . " " . $table . " set " . rtrim($setter, ",") . " where id=" . $id;
		if(mysqli_query($mysqli, $sql)) {
			$isExecuted = true;
		}
		break;
	}
	return $isExecuted;
}

function getID() {
	global $lastinsertid;
	return $lastinsertid;
}

function getJSONdata( $query ) {
	global $mysqli;
	$res = mysqli_query($mysqli, $query);
	$data = array();
	while ($row = mysqli_fetch_object( $res )) {
		# code...
		$data[] = $row;
	}
	return $data;
}

function checkRows( $query ) {
	global $mysqli;
	$res = mysqli_query($mysqli, $query);
	return mysqli_num_rows($res);
}

function str( $string ) {
	return "'" . $string . "'";
}

function generateApi() {
	global $mysqli;
	return md5(date('m/d/y h:i:sa') . "-" . rand(000000,999999) . mysqli_insert_id($mysqli));
}

function jsRedirect( $url ) {
	echo '
	<script type="text/javascript">
	window.location.href = "' . $url . '";
	</script>
	';
}	