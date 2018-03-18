<div class="page">
	<div id="edit-page" class="page-vh">
		<div id="edit-form">
			
			<h2>Modifiez vos informations</h2>

			<form class="form" method="post">
				<?php if(isset($edit_error)): ?>
					<div class="error"><?= $edit_error; ?></div>
				<?php elseif(isset($success)): ?>
					<div class="success"><?= $success; ?></div>
				<?php endif; ?>

				<p>
					<label for="edit_name">Nom d'utilisateur :</label><br />
					<input type="text" name="edit_name" id="edit_name" value="<?=$_SESSION['user']['name']; ?>"/>
				</p>
				<p>
					<label for="edit_mail">Votre adresse mail :</label><br />
					<input type="email" name="edit_mail" id="edit_mail" value="<?= $_SESSION['user']['mail']; ?>"/>
				</p>
				<p>
					<label for="old_pass">Entrez votre ancien mot de passe :</label><br />
					<input type="password" name="old_pass" id="old_pass" />
				</p>
				<p>
					<label for="edit_pass">Nouveau mot de passe :</label><br />
					<input type="password" name="edit_pass" id="edit_pass" />
				</p>
				<p>
					<label for="confirm_edit_pass">Confirmez le nouveau mot de passe :</label><br />
					<input type="password" name="confirm_edit_pass" id="confirm_edit_pass" />
				</p>
				<p>
					<input type="submit" name="edit_info" value="Mettre à jour" />
				</p>
			</form>
		</div>
	</div>
</div>