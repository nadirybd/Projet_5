<div class="page form-page" id="edit-message">
	<div class="form-container">
		
		<h1>Editez votre message</h1>
		
		<?php if(isset($error_delete)): ?>
			<div class="error"><?= $error_delete; ?></div>
		<?php endif; ?>

		<form class="form" id="edit-message-form" method="post">
			<?php if(isset($error_edit)): ?>
				<div class="error"><?= $error_edit; ?></div>
			<?php elseif (isset($success)): ?>
				<div class="success"><?= $success; ?></div>
			<?php endif; ?>
			<p>
				<textarea name="edit_message"><?= htmlspecialchars($message->content); ?></textarea>
			</p>
			<p>
				<input type="submit" name="sub-editMessage" value="Mettre  à jour" />
				<button class="btn btn-cancel" id="btn-delete-msg" type="button">Supprimer</button>
			</p>
		</form>	
		
		 <div id="section-delete-message">
			<p><span class="delete">Toutes les données seront définitivement supprimer</span></p>
			<form class="form delete-message-form" method="post">
				<p>
					<input type="text" name="delete_msg" placeholder="Veuillez écrire le mot : SUPPRIMER"/>
				</p>
				<p>
					<button class="btn btn-cancel" type="submit" name="sub-delete-msg">Supprimer</button>
					<button class="btn btn-validate" id="btn-edit-msg" type="button">Modifier</button>
				</p>
			</form>
		 </div>	
		<p><a href="topic/webmastertopic-<?= $message->topic_id; ?>-1">Retourner au topic</a></p>
	</div>

</div>
<script src="public/js/form/form-edit.js"></script>