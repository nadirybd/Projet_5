<div class="page form-page" id="delete-page">	
	<div class="form-container">	
		<h1>SUPPRESSION DE L'ÉVÉNEMENT</h1>
		<p><span class="delete">Toutes les données seront définitivement supprimer</span></p>
		<?php if(isset($error_delete)): ?>
			<div class="error"><?= $error_delete; ?></div>
		<?php endif; ?>
		<form class="form delete-event-form" method="post">
			<p>
				<input type="text" name="confirm_delete_event" placeholder="Veuillez écrire le mot : SUPPRIMER"/>
			</p>
			<p>
				<button class="btn btn-cancel" type="submit" name="sub-delete-event">Supprimer</button>
			</p>
		</form>
		<p><a href="admin">Retourner à l'administration</a></p>
	</div>
</div>	