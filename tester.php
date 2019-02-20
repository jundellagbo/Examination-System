<?php
include "config.php";
include "function/function.php";

/*
dataExecute("insert", "admin", 
	[
	"username" => str("admin"),
	"password" => str(md5("admin")),
	"auth"	=> str(generateApi())
	], null);

*/

/*
dataExecute("update", "admin", 
	[
	"username" => str("jundell"),
	"password" => str(md5("admin")),
	"auth"	=> str(generateApi())
	], 14);

	*/

/*
$query = "select * from admin";
foreach (getJSONdata($query) as $key => $value) {
	# code...
	echo $value->id;
}
*/

//dataExecute("delete", "admin", null, 13);