<?php include 'includes/bdd.php';include 'includes/fonctions.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<title>Blog Ozanam</title>
		<link rel="stylesheet" media="screen" type="text/css" href="style/style.css" />
	</head>
	<section>
		<header>
			<div class="row"><div class="12u" id="logo"> <!-- Logo --><h1><a href="index.php" class="mobileUI-site-name">Blog Ozanam 1°SB</a></h1></div>
			</div>
			<div class="row">
				<div class="12u" id="menu">
						<ul>
							<li class="first"><a href="index.php">Accueil</a></li>
							<li><a href="#">Cours</a></li>
							<?php if(!isset($_SESSION['id'])){ ?><li><a href="connexion.php">Connexion</a></li><?php } else { ?> <li><a href="redaction.php">Redaction</a></li> <li><a href="deconnexion.php">Deconnexion</a></li><?php } ?>
						</ul>
				</div>
			</div>
		</header>
		<footer id="footer">
			<p class="copyright">&copy Blog de Merde. Une création d'un <a href="crypt.php" style="text-decoration:none;color:#FFFFFF">parfait</a> inconnu.</p>
		</footer>
	</section>
	<body id="corps">