<?php
	session_start();

	require_once('nusoap/lib/nusoap.php');

	$client = new nusoap_client('http://localhost/tasit/server.php?wsdl', true);

	if(ISSET($_SESSION['username'])){
		//jika tidak ada session
	} else{
		header("location:login.php");
	}

	$result = active();
	$home = "";
	$pel = "";
	$buku = "";

	if ($result == "sewa") {
		$home = "active";
	}elseif ($result == "pelanggan") {
		$pel = "active";
	}elseif($result == "buku"){
		$buku = "active";
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<html>
	<head>
		<meta charset="utf-8">
     	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="stylesheet" href="asset/css/bootstrap.css">
		<link rel="stylesheet" href="asset/css/navbar-fixed-top.css">
		<script src="http://ajax.gooleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="asset/js/bootstrap.js"></script>
    	<script src="asset/js/jquery.min.js"></script>
		<title>Sistem Penyewaan Buku</title>
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top nav-col" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a href="index.php" class="navbar-brand" style="color:white">SIEREK</a>
				</div>
				<div>
					<ul class="nav navbar-nav">
						<li class="<?php echo $home; ?>"><a href="index.php">HOME</a></li>
						<li class="<?php echo $pel; ?>"><a href="pelanggan.php">PELANGGAN</a></li>
						<li class="<?php echo $buku; ?>"><a href="buku.php">BUKU</a></li>
					</ul>
					<ul class="nav navbar-right navbar-nav">
						<li><a href="#">Anda Login Sebagai <?php echo $_SESSION['username']; ?></a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>