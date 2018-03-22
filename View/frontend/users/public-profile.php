<div class="page">
	<div id="profile-page">
		<div id="profile-content">
			<aside class="avatar">
				<p><img src="View/backend/users/avatars/<?= $user->avatar; ?>" /></p>
			</aside>
			<div id="profile-info">
				<fieldset>
					<legend>Information de l'utilisateur</legend>
					<p><i class="fas fa-user"></i> <?= htmlspecialchars($user->pseudo); ?></p>
					<p><i class="fas fa-envelope"></i> <?= $user->mail; ?></p>
					<p><i class="fas fa-calendar-alt"></i> Date d'inscription : <?= $user->sub_date_fr; ?></p>
				</fieldset>

				<section id="profile-description">
					<h3>Description</h3>
					<?php if(!empty($infoUser->description)): ?>
						<div class="description-content"><?= htmlspecialchars($infoUser->description); ?></div>
					<?php else: ?>
						<div class="description-content">Aucune description</div>
					<?php endif; ?>
				</section>
			</div>
		</div>
	</div>
</div>
