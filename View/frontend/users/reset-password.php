<div id="reset-pass-page" class="page form-page">
	<div class="form-container">
		<h2>Entrez votre nouveau mot de passe</h2>
		<form class="form" id="form-recup" method="post">
			<?php if(isset($error)) : ?>
				<div class="error"><?= $error; ?></div>
			<?php endif; ?>
			<p>
				<label for="reset_pass">Nouveau mot de passe :</label><br/>
				<input type="password" name="reset_pass" id="reset_pass" placeholder="Nouveau mot de passe" required />
			</p>
			<p>
				<label for="confirm_reset_pass">Confirmez votre nouveau mot de passe :</label>
				<input type="password" name="confirm_reset_pass" id="confirm_reset_pass" placeholder="Confirmez votre nouveau mot de passe" required />
			</p>

			<input type="submit" name="send_reset" value="Mettre à jour"/>
		</form>
	</div>
</div>


