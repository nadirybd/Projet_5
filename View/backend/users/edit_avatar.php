<div class="page form-page">
	<div class="form-container">
		<h2>Votre avatar</h2>
		<aside class="avatar">
			<p><img src="/Forum/View/backend/users/avatars/<?= $user->avatar; ?>"></p>	
		</aside>

		<form class="form" method="post" enctype="multipart/form-data">
			<?php if(isset($avatarError)): ?>
				<div class="error"><?= $avatarError; ?></div>
			<?php elseif(isset($success)): ?>
				<div class="success"><?= $success; ?></div>
			<?php endif; ?>
			<p>
				<label for="edit_avatar">Sélectionner votre avatar</label><br />
				<input type="file" name="file_avatar" id="edit_avatar" />
			</p>
			<p>
				<input type="submit" name="submit_avatar" value="Changer votre avatar" />
			</p>
		</form>
	</div>
</div>