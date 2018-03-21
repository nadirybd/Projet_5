<div class="recup-password-page" class="page">
	<div class="form-recup-pass">
		<h2>Entrez votre code de récupération</h2>
		<form class="form form-recup" method="post">
			<?php if(isset($success)) : ?>
				<div class="success"><?= $success; ?></div>
			<?php elseif(isset($error)) : ?>
				<div class="error"><?= $error; ?></div>
			<?php endif; ?>
			<p>
				<label for="recup_code"><i class="fas fa-key"></i></label>
				<input type="text" name="recup_code" id="recup_code" placeholder="Entrez votre code de récupération" required />
			</p>
			
			<p><a href="recuperation-mail">Vous n'avez toujours pas de code ?</a></p>

			<input type="submit" name="send_code" value="Confirmez le code"/>
		</form>
	</div>
</div>


