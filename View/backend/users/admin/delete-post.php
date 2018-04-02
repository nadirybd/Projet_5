<div class="page form-page" id="delete-page">	
	<div class="form-container">	
		<h1>CONFIRMEZ LA SUPPRESSION DE L'ARTICLE</h1>
		<p><span class="delete">Toutes les données seront définitivement supprimer</span></p>
		<?php if(isset($error_delete)): ?>
			<div class="error"><?= $error_delete; ?></div>
		<?php endif; ?>
		<form class="form delete-topic-form" method="post">
			<p>
				<input type="text" name="confirm_delete_post" placeholder="Veuillez écrire le mot : SUPPRIMER"/>
			</p>
			<p>
				<button class="btn btn-cancel" type="submit" name="sub-delete-post">Supprimer</button>
			</p>
		</form>
		<p><a href="admin">Retourner à l'administration</a></p>
	</div>
</div>	