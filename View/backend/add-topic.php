<div class="page form-page">
	<div class="form-container">
			<form class="form" id="form-topic" method="post">
				<?php if(isset($error_addtopic)): ?>
					<div class="error"><?= $error_addtopic; ?></div>
				<?php endif; ?>
			<p>
				<label for="addtopic_title">Sujet du topic :</label><br />
				<input type="text" name="addtopic_title" id="addtopic_title" />
			</p>
			<p>
				<label for="addtopic_cat">Catégorie</label><br />
				<select name="addtopic_cat" id="addtopic_cat">
					<option>Veuillez choisir une catégorie</option>
					<?php foreach($categories as $category): ?>
						<option class="category" value="<?= $category->id; ?>"><?= $category->name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<div id="sub-option"></div>
			
			<p>
				Contenu du topic : <br/><br/>
				<textarea name="addtopic_content"></textarea>
			</p>
			<p>
				<label for="notif">Activer les notifications</label>
				<input type="checkbox" name="notif_on" id="notif"/>
			</p>
			<p>
				<input type="submit" name="submit-addtopic" value="Créer le topic" />
			</p>
		</form>
	</div>
</div>

<script src="public/js/ajax-topic.js"></script>