<div class="page" id="profile-page">	
	<div id="profile-content">
		<div id="profile-info">
			<div id="bar-info">
				<aside class="avatar">
					<p><img src="View/backend/users/avatars/<?= $user->avatar; ?>" /></p>
				</aside>
				<div class="user-info">
					<h3>Vos informations</h3>
					<p><i class="fas fa-user"></i> <?= htmlspecialchars($user->pseudo); ?></p>
					<p><i class="fas fa-envelope"></i> <?= htmlspecialchars($user->mail); ?></p>
					<p><i class="fas fa-calendar-alt"></i> Date d'inscription : <?= $user->sub_date_fr; ?></p>
				</div>
			</div>

			<section id="profile-description">
				<h3>À Propos de <?= $user->pseudo; ?></h3>
				<?php if(!empty($infoUser->description)): ?>
					<div class="description-content"><?= htmlspecialchars($infoUser->description); ?></div>
				<?php else: ?>
					<div class="description-content">Aucune description</div>
				<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
</div>