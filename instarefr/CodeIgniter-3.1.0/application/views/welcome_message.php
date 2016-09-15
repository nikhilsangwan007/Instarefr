<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="google-signin-client_id" content="1095141978516-uqea8udtat0463k3ukomrj1obouacggv.apps.googleusercontent.com">
	<title>INSTAREFR</title>

	<!-- Scripts -->
	<script type="text/javascript" src="../CodeIgniter-3.1.0/lib/jquery.js"></script>
	<script type="text/javascript" src="../CodeIgniter-3.1.0/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../CodeIgniter-3.1.0/lib/angular.js"></script>
	<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
	<script type="text/javascript" src="../CodeIgniter-3.1.0/lib/angular-route.min.js"></script>
	<script type="text/javascript" src="../CodeIgniter-3.1.0/lib/angular-cookies.min.js"></script>
	<script type="text/javascript" src="https://platform.linkedin.com/in.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>   
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>


	<!-- CUSTOM SCRIPTS -->
	<script type="text/javascript" src="../CodeIgniter-3.1.0/custom_scripts/mainController.js"></script>
	<script type="text/javascript" src="../CodeIgniter-3.1.0/custom_scripts/controllers.js"></script>

	<!-- CSS LINKS -->
	<link rel="stylesheet" type="text/css" href="../CodeIgniter-3.1.0/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
	<!-- <link rel="stylesheet" type="text/css" href="../CodeIgniter-3.1.0/bootstrap/css/bootstrap-social.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../CodeIgniter-3.1.0/bootstrap/css/bootstrap-social.scss"> -->

	<!-- CUSTOM CSS -->
	<link rel="stylesheet" type="text/css" href="../CodeIgniter-3.1.0/custom_css/homeStyle.css">
	<link rel="stylesheet" type="text/css" href="../CodeIgniter-3.1.0/custom_css/btns.min.css">

</head>
<body ng-app="myApp" ng-controller="loginCtrl">
<!-- RESPONSIVE NAVBAR -->
	<nav class="navbar navbar-fixed-top">
		<a class="navbar-brand" id="navbar-brand" href="#/home">INSTAREFR</a>
		<div class="container-fluid">
		    <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span> 
			    </button>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
			    <ul class="nav navbar-nav navbar-right">
			        <li><a class="btn btn--m" href="#/find-job">Find Job</a></li>
			        <li><a class="btn btn--m" ng-if="loginTab() == true" href="#/post-job">Post Job</a></li>
			        <li><a class="btn btn--m" href="#/companies">companies</a></li>
			        <li><a class="btn btn--m" data-toggle="modal" ng-if="loginTab() != true" data-target="#signUpModal">Login</a></li>
			        <img id="nav-photo" ng-if="loginTab() == true" class="dropdown-toggle" data-toggle="dropdown" src="{{photo}}" width="40px" height="40px">
			        	<!-- DROPDOWN BOX -->
					    <ul class="dropdown-menu" id="dropdown">
					    	<li><a href="#">{{name}}</a></li>
					    	<li><a href="#">Settings</a></li>
					    	<li><a href="#">invite</a></li>
					    	<li class="divider"></li>
					    	<li><a ng-click="logout()">Logout</a></li>
				    </ul>
			    </ul>
		    </div>    
		</div>	
	</nav>
	<div class="clear"></div>
	<!-- MODEL -->
	<div class="modal fade" id="signUpModal" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">SIGNUP USING SOCIAL NETWORKS</h4>
				</div>
				<div class="modal-body">
						<!-- <p>This is a large modal.</p> -->
						<input type="hidden" name='<?php echo "hello"; ?>' value = '<?php echo $this->security->get_csrf_hash(); ?>'>
						<a class="btn btn--m btn--blue" ng-click="FbLogin()">Login With Facebook</a>
						<a class="btn btn--m btn--blue" ng-click="linkedinLogin()">Login With LinkedIn</a>
						<div class="g-signin2" data-onsuccess="onSignIn"></div>
						
				</div>
				</div>
		</div>
	</div>
	<div id="content-id" ng-view></div>
</body>
</html>