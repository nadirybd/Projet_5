<div class="page form-page">
	<div class="form-container">
		<h2>CLORE UN SUJET</h2>
		<p><span class="delete">Le sujet sera fermé et plus aucun commentaire ne sera possible</span></p>
		<?php if(isset($error_close)): ?>
			<div class="error"><?= $error_close; ?></div>
		<?php endif; ?>
		<form class="form" id="close-topic-form" method="post">
			<p>
				<input type="text" name="topic_close" placeholder="Veuillez écrire le mot : CLORE"/>
			</p>
			<p>
				<button class="btn btn-cancel" type="submit" name="sub-close">Clore</button>
				<button class="btn btn-default" onclick="window.location.href = 'admin';" type="button">Annuler</button>
			</p>
		</form>
	</div>
</div>