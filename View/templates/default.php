<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<base href="/Forum/" />
		<link href="https://fonts.googleapis.com/css?family=Bitter|Roboto+Slab" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous" />
		<link rel="stylesheet" type="text/css" href="public/css/style.css" />

		<title>FORUM | MY NEW WEBSITE</title>
	</head>
	<body>
		<header>
			<div id="logo">
				<img src="public/images/logo-header.png" alt="logo">
			</div>
			<nav>
				<ul>
					<li><a href="home">ACCUEIL</a></li>
					<li><a href="#">FORUM</a></li>
					<?php if(isset($_SESSION['user'])): ?>
						<li><a href="profile">VOTRE PROFIL</a></li>
						<li><a href="logout">SE DÉCONNECTER</a></li>
					<?php else: ?>
						<li><a href="login">SE CONNECTER</a></li>
						<li><a href="subscribe">S'INSCRIRE</a></li>
					<?php endif; ?>
					<li class="hamburger"><a href=""><i class="fas fa-bars fa-2x"></i></a></li>
				</ul>
			</nav>	
		</header>

		<div id="main-container">
			<div id="contains">
				<?= $content; ?>
			</div>
		</div>

		<footer>
			<p>Copyright © 2018 Nadir Webmaster Tous droits réservés.</p>
		</footer>

		<script src="public/js/form.js"></script>
		<script src="public/js/main.js"></script>
	</body>
</html>