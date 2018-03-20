<div class="page">
	<div class="recup-password-page">
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
					<input type="email" name="to_mail" id="to_mail" placeholder="Entrez votre adresse mail" />
				</p>
				<?php if(isset($success)) : ?>
					<p><a href="recuperation-code">Cliquez ici pour continuer !</a></p>
				<?php else : ?>
					<p><a href="recuperation-code">Vous avez déjà un code ?</a></p>
				<?php endif; ?>
				<input type="submit" name="send_mail" value="Envoyer à cette adresse mail"/>
			</form>
		</div>
	</div>
</div>
