<div class="page">
	<div id="recup-password-page">
		<div class="form-recup-pass">
			<h2>Récupération de votre mot de passe</h2>
			<form class="form form-recup" method="post">
				<?php if(isset($success)) : ?>
					<div class="success"><?= $success; ?></div>
				<?php elseif(isset($error)) : ?>
					<div class="error"><?= $error; ?></div>
				<?php endif; ?>
				<p>
					<label for="to_mail"><i class="fas fa-at"></i></label>
					<input type="mail" name="to_mail" id="to_mail" placeholder="Entrez votre adresse mail" />
				</p>
				<p><a href="">Vous avez déjà un code ?</a></p>
				<input type="submit" name="send_mail" value="Envoyer à cette adresse mail"/>
			</form>
		</div>
	</div>
</div>
