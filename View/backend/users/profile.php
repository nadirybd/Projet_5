<div class="page">
	<div id="profile-page">
		<div class="banner">
			<h1>Votre profil</h1>
		</div>

		<div id="profile-content">
			<aside>
				<p><img src="\Forum\View\backend\users\avatars\<?= $_SESSION['user']['avatar']; ?>" /></p>
				<p><a href="">Modifier</a></p>
			</aside>
			<div id="profile-info">
				<fieldset>
					<legend>Information de l'utilisateur</legend>
					<p>
						Votre nom d'utilisateur : 
						<?= $_SESSION['user']['name']; ?> 
						<a href=""><i class="fas fa-edit"></i></a>
					</p>
					<p>
						Votre adresse mail :
						<?= $_SESSION['user']['mail']; ?> 
						<a href=""><i class="fas fa-edit"></i></a>	
					</p>
					<p>
						Date d'inscription :
						<?= $_SESSION['user']['date']; ?> 
					</p>
				</fieldset>
			</div>
		</div>
	</div>
</div>