<div class="page form-page" id="edit-topic-page">
	<div class="form-container">	
		<h1>Edition de votre topic</h1>
		<form class="form" method="post">
			<?php if(isset($error_edit)): ?>
				<div class="error"><?= $error_edit; ?></div>
			<?php endif; ?>
			<p>
				<label for="edit_title">Sujet :</label><br />
				<input type="text" name="edit_title" id="edit_title" value="<?= htmlspecialchars($topic->title); ?>"/>
			</p>
			<p>
				<textarea name="edit_content"><?= htmlspecialchars($topic->content); ?></textarea>
			</p>
			<p>
				<input type="submit" name="sub-edit-topic" value="Mettre à jour" />
			</p>
		</form>
		<p><a href="profile">Retourner au profil</a></p>
	</div>
</div>