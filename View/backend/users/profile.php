<div class="page">
	<div id="profile-page">
		<div id="profile-content">
			<aside class="avatar">
				<p><img src="View/backend/users/avatars/<?= $user->avatar; ?>" /></p>
				<p><a href="edit-avatar">Modifier</a></p>
			</aside>
			<div id="profile-info">
				<fieldset>
					<legend>Information de l'utilisateur - <a href="edit-profile"><i class="fas fa-edit"></i></a></legend>
					<p><i class="fas fa-user"></i> <?= htmlspecialchars($user->pseudo); ?></p>
					<p><i class="fas fa-envelope"></i> <?= $user->mail; ?></p>
					<p><i class="fas fa-calendar-alt"></i> Date d'inscription : <?= $_SESSION['user']['date']; ?></p>
				</fieldset>

				<section id="profile-description">
					<h3>Description <a><i class="fas fa-edit edit-button"></i></a></h3>
					<?php if(!empty($infoUser->description)): ?>
						<div class="description-content"><?= htmlspecialchars($infoUser->description); ?></div>
					<?php else: ?>
						<div class="description-content">Aucune description</div>
					<?php endif; ?>
					<div id="description-container">
						<form method="post">
							<?php if(isset($description_error)): ?>
								<div class="error">
									<?= $description_error; ?>
								</div>
							<?php endif; ?>
							<?php if(!empty($infoUser->description)): ?>
							<textarea class="text-edit" name="edit_description"> <?= htmlspecialchars($infoUser->description);  ?></textarea>
							<?php else: ?>
							<textarea class="text-edit" name="edit_description"></textarea>
							<?php endif; ?>
							<p>
								<input type="submit" name="sub_description" />
								<button class="cancel" type="button">Annuler</button>
							</p>
						</form>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>

<script src="public/js/form/description-form.js"></script>