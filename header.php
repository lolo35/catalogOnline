<?php
session_start();
require_once 'conn.php';
require_once 'functions.php';
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Catalog Online</title>
        <link rel="icon" href="images/trace-logo.ico">
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=2, shrink-to-fit=yes">
		<script src="js/glm-ajax.js" type="text/javascript"></script>
		<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/all.js"></script>
		<script type="text/javascript" src="js/Chart.bundle.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="css/custom-style.css" />
		<link rel="stylesheet" href="css/all.css">
	</head>
	<body style="background-color: #EDEDED;">
		<header class="text-center">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded colors" id="navbar">
				<a class="navbar-brand" href="#" style="color: white; font-family: Arial; font-size: 1.8em; font-weight: bold;">
					<!--<img src="images/logo-minister.png" width="90" height="60" class="rounded img-fluid" alt="brand icon">-->
					<img src="images/e_blue.ico" width="44" height="44" alt="">
				</a>
        <h4 id="header-text"></h4>
				<div class="my-2 my-lg-0">
					<!--<img src="images/logo-minister.jpg" class="rounded img-fluid" width="150" height="50" alt="Autoliv Logo">-->
					<h2 style="color: white; font-family: Georgia Pro; border-bottom: 10px solid white;"><strong>Scoala Generala Nr. 2</strong></h2>
				</div>
			</nav>
		</header>
		<br>
