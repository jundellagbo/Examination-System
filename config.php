<?php

session_start();

$connection = [
"host" 			=> "localhost",
"user" 			=> "root",
"password" 		=> "",
"db" 			=> "exam"
];

define("servername", "http://localhost/exam");
define("user", "#2fbfe8");
define("admin", "#2fe868");

$mysqli = new mysqli($connection["host"], $connection["user"], $connection["password"], $connection["db"]) or die("Network Connection Error.");