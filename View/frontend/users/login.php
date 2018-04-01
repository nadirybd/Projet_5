<div id="login-page" class="form-page">	
	<div class="form-container">
		<h2>Authentification</h2>
		
		<form class="form" id="log-form" method="post">
			<?php if(isset($log_error)): ?>
				<div class="error"><?= $log_error; ?></div>
			<?php endif; ?>
			<p>
				<label for="log_user"><i class="fas fa-user"></i></label>
				<input type="text" name="log_user" id="log_user" placeholder="Votre nom d'utilisateur ou adresse mail" required />
			</p>
			<p>
				<label for="log_pass"><i class="fas fa-lock"></i></label>
				<input type="password" name="log_pass" id="log_pass" placeholder="Votre mot de passe" required />
			</p>
			<p>
				<label for="log_remember">Se souvenir de moi </label>
				<input type="checkbox" name="log_remember" id="log_remember" />
			</p>
			<p>
				<input type="submit" name="login" value="Se connecter" />
			</p>
		</form>

		<p><a href="recuperation-mail">Mot de passe oublié ?</a></p>
		<p>Vous n'avez toujours pas de compte ? <a href="subscribe">Inscrivez-vous !</a></p>
	</div>
</div>


