<?php
session_start();
if (isset($_SESSION['VIN'])) {
	header("Location: dashboard.php");
}
include 'admin/inc/config.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/coatofarms.jpg">
	<link rel="icon" type="image/png" href="assets/img/coatofarms.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Nigeria E-Voting | Homepage</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-kit.css" rel="stylesheet"/>
	<style>
		li a:hover{
			color:red !important;
			font-weight:bolder;
		}
	</style>

</head>

<body class="landing-page">
    <nav class="navbar navbar-transparent navbar-absolute">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        		<a class="navbar-brand" href="#"><img src="assets/img/coat_of_arms.jpg" class="img-circle img-responsive"/>  Nigeria <b>E_Voting</b></a>
        	</div>

        	<div class="collapse navbar-collapse" id="navigation-example">
        		<ul class="nav navbar-nav navbar-right">
    				<li>
    					<a data-toggle="modal" data-target="#aboutModal">
    						About the Developer
    					</a>
					</li>
					<li>
    					<a href="validate/">
    						Validate
    					</a>
    				</li>
    				<li>
    					<a href="result.php">
    						Result
    					</a>
    				</li>
    				<li>
    					<a href="login.php">
    						Admin Login
    					</a>
    				</li>
					<li>
    					<a href="user_login.php">
    						User Login
    					</a>
    				</li>
        		</ul>
        	</div>
    	</div>
    </nav>

    <div class="wrapper">
        <div class="header header-filter" style="background-image: url('assets/img/ng_flag2.png');">
            <div class="container">
                <div class="row">
					<center><div class="col-md-12">
						<h3 class="title">vote for your candidate</h3>
	                    <br />
	                    <a data-toggle="modal" data-target="#loginModal" class="btn btn-success btn-raised btn-lg">Vote</a>
					</div></center>
                </div>
            </div>
        </div>

			<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" align="center" id="myModalLabel">Login with the details sent to you</h4>
			      </div>
			      <form method="post" action="#">
				      <div class="modal-body">
				        <div class="form-group">
				        	<div class="form-group label-floating">
								<label class="control-label">VIN</label>
								<input type="password" name="VIN" class="form-control" required>
							</div>
				        </div>
				        <div class="form-group">
				        	<div class="form-group label-floating">
								<label class="control-label">OTP</label>
								<input type="password" name="qrcode" class="form-control" required>
							</div>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
				        <button name="submit" class="btn btn-info btn-simple">Login</button>
				      </div>
			      </form>
			      <?php
			      	if (isset($_POST['submit'])) {
						  $start_vote= date('H');
						  $end_vote=date('H');
						  $vote_period = mysql_query("SELECT * FROM citizens ");
						  $row = mysql_fetch_array($vote_period);
						  $s=$row['vote_starts'];
						  $e=$row['vote_ends'];
						  if($start_vote>=$row['vote_starts'] && $end_vote<=$row['vote_ends']){


			      			$VIN = $_POST['VIN'];
			      			$qrcode = $_POST['qrcode'];
			      			$validate = mysql_query("SELECT * FROM citizens WHERE VIN='$VIN' AND email ='$qrcode' AND voted = '0'");
			      			if (mysql_num_rows($validate)) {
			      				$_SESSION['VIN'] = $VIN;
			      				echo "<script>window.open('dashboard.php','_self')</script>";
			      		}else{
			      			echo "<script>alert('Incorrect Login Details or you have voted before(Duplicate Vote not allowed)')</script>";
			      			
						  }
						}else{
							echo "<script> alert('vote starts by '.$s.' :00AM  and end by '.$e.' :00PM');</script>";
						}
			      	}
			      ?>
			    </div>
			  </div>
			</div>


			<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" align="center" id="myModalLabel">About the developer</h4>
			      </div>
				      <div class="modal-body">
				        <div class="row">
				        	<div class="col-md-5">
				        		<img src="assets/img/coatofarms.jpg" class="img-responsive" width="200" height="200">
				        	</div>
				        	<div class="col-md-7">
				        		<p><b>Name:</b> Edit to your name<br>
				        		<b>Reg. Number</b> enter Your Regno<br>
				        		<b>Project Topic</b> Nigeria E-voting<br>
				        		<b>Project Supervisor</b> Enter your supervisor name<br>
				        		</p>
				        	</div>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
				      </div>
			    </div>
			  </div>
			</div>

			
	    <footer class="footer">
	        <div class="container">
	            <div class="copyright pull-center">
	                &copy;<b id="y"></b>.  <a href="#">Nigeria E_Voting</a>
	            </div>
	        </div>
	    </footer>

	</div>
</body>

	<!--   Core JS Files   -->
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/material.min.js"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="assets/js/nouislider.min.js" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="assets/js/material-kit.js" type="text/javascript"></script>
	<script src="assets/js/my-script.js"></script>

</html>
