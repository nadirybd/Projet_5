<div class="page" id="edit-message">
	<h1>Editez votre message</h1>
		<form class="form edit-message-form" method="post">
		<?php if(isset($error_edit)): ?>
			<div class="error"><?= $error_edit; ?></div>
		<?php elseif (isset($success)): ?>
			<div class="success"><?= $success; ?></div>
		<?php endif; ?>
		<textarea name="edit_message"><?= htmlspecialchars($message->content); ?></textarea>
		<p>
			<input type="submit" name="sub-editMessage" value="Mettre  à jour" />
			<button class="cancel-button"><a href="topic/webmastertopic-<?= $message->topic_id; ?>-1">Annuler</a></button>
		</p>
	</form>
</div>