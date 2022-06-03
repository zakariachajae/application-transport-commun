<?php 
  
  require_once 'lib/db.php'; 
  
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>CTIIR6</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/util.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<?php 
 // Init session
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
 ?>
	<body class="is-preload">

		
			<div id="wrapper" class="fade-in">

				
					<div id="intro">
						<h1>CTIIR6</h1>
		
						<ul class="actions">
							<li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
						</ul>
					</div>

				
					<header id="header">
						<a href="index.html" class="logo">SITE DE TRANSPORT COMMUN</a>
					</header>

				
					<nav id="nav">
						<ul class="links">
							<?php if (isset($_SESSION["name"]) && !empty($_SESSION["name"]) && $_SESSION["name"]=="admin"){ ?>
							<li><a href="ModifLigne.php">modif ligne</a></li>
							<li><a href="horaire.php">Les horaires</a></li>
							<li><a href="tarifs.php">tarifs</a></li>
							<li><a href="contact_me.php">complaints</a></li>
							<li><a href="map.php">manip map</a></li>
						</ul>
						<ul class="icons">
							<li style="font-family: 'Courier New', Courier, monospace;"> Welcome <?php echo $_SESSION["name"] ;?>  </li>
							 
							 <a href='logout.php'> <button>logout </button></a>
							<?php }else { ?>
								<li><a href="index.php"> trajet</a></li>
							<li><a href="horaire.php">Les horaires</a></li>
							<li><a href="tarifs.php"> tarifs</a></li>
							<li><a href="contact.php">contact</a></li>
							<li><a href="map.php">la map</a></li>
						</ul>
						<ul class="icons">
							 <a href='login.php'> <button>login admin </button></a>
							 
							<?php } ?>
							 
							
						</ul>
					</nav>
					<!--this will be on each document-->
					</header>

					<div id="main">

						
									
								