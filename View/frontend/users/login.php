<div class="page">
	<div id="login-page">	
		<div id="login-content">
			<h2>Authentification</h2>
			
			<form class="form log-form" method="post">
				<?php if(isset($log_error)): ?>
					<p><span class="error"><?= $log_error; ?></span></p>
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

			<p><a href="#">Mot de passe oublié ?</a></p>
			<p>Vous n'avez toujours pas de compte ? <a href="index.php?p=subscribe">Inscrivez-vous !</a></p>
		</div>
	</div>
</div>