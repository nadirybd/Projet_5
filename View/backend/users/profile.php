<div class="page">
	<div id="profile-page">
		<div class="banner">
			<h1>Votre profil</h1>
		</div>

		<div id="profile-content">
			<aside class="avatar">
				<p><img src="/Forum/View/backend/users/avatars/<?= $user->avatar; ?>" /></p>
				<p><a href="index.php?p=edit_avatar">Modifier</a></p>
			</aside>
			<div id="profile-info">
				<fieldset>
					<legend>Information de l'utilisateur - <a href="index.php?p=edit_profile"><i class="fas fa-edit"></i></a></legend>
					<p><i class="fas fa-user"></i> <?= $user->pseudo; ?></p>
					<p><i class="fas fa-envelope"></i> <?= $user->mail; ?></p>
					<p><i class="fas fa-calendar-alt"></i> Date d'inscription : <?= $_SESSION['user']['date']; ?></p>
				</fieldset>

				<section id="profile-description">
					<h3>Description <a><i class="fas fa-edit"></i></a></h3>
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