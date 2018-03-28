<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<base href="/Forum/" />
		<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous" />
		<link rel="stylesheet" type="text/css" href="public/css/style.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<title>FORUM | MY NEW WEBSITE</title>
	</head>
	<body>
		<header>
			<div id="logo">
				<a href="home"><img src="public/images/logo-header.png" alt="logo"></a>
			</div>
			<nav>
				<ul>
					<li><a href="home">ACCUEIL</a></li>
					<?php if(isset($_SESSION['user'], $_SESSION['admin'])): ?>
						<li><a href="admin">ADMINISTRATION</a></li>
					<?php endif; ?>
					<li><a href="webmaster-forum">FORUM</a></li>
					<?php if(isset($_SESSION['user'])): ?>
						<li><a href="logout">SE DÉCONNECTER</a></li>
						<li><a href="profile"><i class="fas fa-user-circle fa-2x"></i></a></a></li>
					<?php else: ?>
						<li><a href="login">SE CONNECTER</a></li>
						<li><a href="subscribe">S'INSCRIRE</a></li>
					<?php endif; ?>
					<li class="hamburger"><a href=""><i class="fas fa-bars fa-2x"></i></a></li>
				</ul>
			</nav>	
		</header>

		<?= $menuBis; ?>

		<div class="overlay"></div>
		
		<div id="main-container">
			<div id="contains">
				<?= $content; ?>
			</div>
		</div>

		<footer>
			<p>Copyright © 2018 Yebdri Webmaster Tous droits réservés.</p>
		</footer>

		<script src="public/js/form/validate-form.js"></script>
		<script src="public/js/main.js"></script>
	</body>
</html>