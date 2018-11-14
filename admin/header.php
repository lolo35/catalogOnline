<?php
session_start();
require_once 'conn.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Catalog Online</title>
        <link rel="icon" href="images/trace-logo.ico">
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=2, shrink-to-fit=yes">
		<script src="js/glm-ajax.js" type="text/javascript"></script>
		<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>-->
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/all.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="css/custom-style.css" />
		<link rel="stylesheet" href="css/all.css">
	</head>
	<body style="background-color: #EDEDED;">
		<header>
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded colors" id="navbar">
				<a class="navbar-brand" href="#">
					<img src="images/trace-logo.png" width="90" height="60" class="rounded img-fluid" alt="brand icon">
                  Admin Catalog Online
				</a>
                <h4 id="header-text"></h4>
				<div class="my-2 my-lg-0">
					<!--<img src="images/autoliv_logo.png" class="rounded img-fluid" width="150" height="50" alt="Autoliv Logo">-->
				</div>
			</nav>
		</header>
		<br>
