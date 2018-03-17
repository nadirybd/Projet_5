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
					<legend>Information de l'utilisateur - <a href=""><i class="fas fa-edit"></i></a></legend>
					<p>
						Votre nom d'utilisateur : 
						<?= $_SESSION['user']['name']; ?> 
					</p>
					<p>
						Votre adresse mail :
						<?= $_SESSION['user']['mail']; ?> 
					</p>
					<p>
						Date d'inscription :
						<?= $_SESSION['user']['date']; ?> 
					</p>
				</fieldset>

				<section>
					<h3>Description <a href=""><i class="fas fa-edit"></i></a></h3>
					<?php if(!empty($infoUser->description)): ?>
						<p><?= $infoUser->description; ?></p>
					<?php else: ?>
						<p>Aucune description</p>
					<?php endif; ?>
				</section>
			</div>
		</div>
	</div>
</div>