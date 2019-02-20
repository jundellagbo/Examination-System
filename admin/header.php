<?php 
include "../config.php";
include "../function/function.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo servername; ?>/admin/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo servername; ?>/admin/css/styles.css">
	<style type="text/css">
		body {
			background: <?php echo admin; ?>;
		}
	</style>
	<script type="text/javascript" src="<?php echo servername; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo servername; ?>/js/bootstrap.min.js"></script>
</head>
<body >
<?php 
if( !isset($_SESSION["adminID"] )) {
	jsRedirect("index.php");
}
if( isset($_GET["logout"] )) {
	if( $_GET["logout"] == $_SESSION["adminID"]) {
		unset($_SESSION["adminID"]);
		jsRedirect("index.php");
	}
}
$query = "select * from admin where auth='" . $_SESSION["adminID"] . "'";
$userdata = json_decode(json_encode(getJSONdata($query)), true);
?>
<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="dashboard.php">Cordova Public College<!-- img src="	images/ke.png"> --> <!-- <?php echo $userdata[0]["firstname"]; ?> --></a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <form method="post" action="results.php">
	                  	<div class="input-group form">
	                       <input type="text" name="search" class="form-control" placeholder="Search Student">
	                       <span class="input-group-btn" required>
	                         <input type="submit" class="btn btn-primary" name="find" type="button" value="Search">
	                       </span>
	                  </div>
	                  </form>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="users.php?showusers=true">My Students</a></li>
	                          <li><a href="account.php">Profile</a></li>
	                          <li><a href="?logout=<?php echo $_SESSION["adminID"]; ?>">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="<?php echo $link == "remarks" ? "current" : ""; ?>"><a href="<?php echo servername; ?>/admin/remarks.php"><i class="glyphicon glyphicon-stats"></i> Remarks</a></li>
                    <li class="<?php echo $link == "examination" ? "current" : ""; ?>"><a href="<?php echo servername; ?>/admin/examination.php"><i class="glyphicon glyphicon-question-sign"></i> Examination</a></li>
                    <li class="<?php echo $link == "users" ? "current" : ""; ?>"><a href="<?php echo servername; ?>/admin/users.php"><i class="glyphicon glyphicon-user"></i> Users</a></li>
                    <!--
                    <li class="<?php //echo $link == "admin" ? "current" : ""; ?>"><a href="staff.php"><i class="glyphicon glyphicon-lock"></i>Staff</a></li>-->
                    <li class="<?php echo $link == "department" ? "current" : ""; ?>"><a href="<?php echo servername; ?>/admin/department.php"><i class="glyphicon glyphicon-star"></i>Department</a></li>
                </ul>
             </div>
		  </div>