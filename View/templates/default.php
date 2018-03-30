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
		<link rel="shortcut icon" type="image/x-icon" href="public/images/favicon.png" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  		<script src="public/js/tinymce.js"></script>
		<title>FORUM | MY NEW WEBSITE</title>
	</head>
	<body>
		<header>
			<div id="logo">
				<a href="home"><img src="public/images/logo-header.png" alt="logo"></a>
			</div>
			<div id="main-menu">
				<a href="home"><i class="fas fa-home"></i> ACCUEIL</a>
				<a href="webmaster-forum">FORUM</a>
				<a href="blog">BLOG</a>
				<?php if(isset($_SESSION['user'])): ?>
					<div id="user-menu">
						<i class="fas fa-user-circle fa-2x"></i>
					<?php if(isset($_SESSION['user'])): ?>
						<div id="side-bar">
							<div class="side-content">
								<i class="fas fa-caret-up fa-3x"></i>
								<p><span class="side-avatar"><a href="profile"><img src="View/backend/users/avatars/<?= $_SESSION['user']['avatar']; ?>"></a></span></p>
								<p><?= strtoupper(($_SESSION['user']['name'])); ?></p>
								<hr />
								<p><a href="profile">VOTRE PROFIL</a></p>
								<hr />
								<?php if(isset($_SESSION['user'], $_SESSION['admin'])): ?>
									<p><a href="admin">ADMINISTRATION</a></p>
								<hr/>
								<?php endif; ?>
								<p><a href="add-topic">AJOUTER UN TOPIC</a></p>
								<hr />
								<p><span class="logout"><a href="logout">
									<i class="fas fa-power-off"></i> DÉCONNEXION</a></span></p>
							</div>
						</div>
					<?php endif; ?>
					</div>
				<?php else: ?>
					<a href="login">SE CONNECTER</a>
					<a href="subscribe">S'INSCRIRE</a>
				<?php endif; ?>
				<span class="burger"><a href=""><i class="fas fa-bars fa-2x"></i></a></span>
			</div>
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