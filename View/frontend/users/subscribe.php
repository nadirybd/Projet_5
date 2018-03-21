<div id="subscribe-page" class="page">
	<div id="subscribe-form">
		<aside>
			<h2>Rejoignez la communauté, partagez votre savoir ou bien enrichissez-le !</h2>
			<h3>Créer votre compte</h3>
		</aside>

		<?php if(isset($error)): ?>
			<div class="error"><?= $error; ?></div>
		<?php endif; ?>
		<form class="form sub-form" method="post">
			<p>
				<label for="username">*Nom d'utilisateur :</label><br />
				<input type="text" name="username" id="username" required/>
			</p>
			<p>
				<label for="mail">*Adresse mail :</label><br />
				<input type="email" name="mail" id="mail" required/>
			</p>
			<p>
				<label for="confirm_mail">*Confirmez votre adresse mail :</label><br />
				<input type="email" name="confirm_mail" id="confirm_mail" required/>
			</p>
			<p>
				<label for="pass">*Mot de passe :</label><br />
				<input type="password" name="pass" id="pass" required/>
			</p>
			<p>
				<label for="confirm_pass">*Confirmez le mot de passe :</label><br />
				<input type="password" name="confirm_pass" id="confirm_pass" required/>
			</p>
			<p>
				<input type="submit" name="subscribe" value="S'inscrire" />
			</p>
			<p>* champs obligatoires</p>
			<p><a href="login">Vous avez déjà un compte ?</a></p>
		</form>
	</div>
</div>

