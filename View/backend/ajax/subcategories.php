<label for="addtopic_cat">Sous-catégorie</label><br />
<select name="addtopic_subcat">
	<?php foreach($subcategories as $sub): ?>
		<option value="<?= $sub->id; ?>"><?= $sub->name; ?></option>
	<?php endforeach; ?>
</select>