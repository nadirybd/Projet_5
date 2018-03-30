<div class="page form-page">
	<div class="form-container">
		<form class="form" method="post" enctype="multipart/form-data">
			<?php if(isset($post_error)): ?>
				<div class="error"><?= $post_error; ?></div>
			<?php endif; ?>
			<p>
				<label for="post_title">Titre de l'article</label><br />
				<input type="text" name="add_post_title" id="post_title" />
			</p>
			<p>
				<label for="post_img">Image de l'article</label><br />
				<input type="file" name="addPost_img" id="post_img" />
			</p>
			<p>
				<textarea name="add_post_content" id="mytextarea"></textarea>
			</p>
			<p>
				<input type="submit" name="sub-add-post" value="Ajouter l'article" />
			</p>
		</form>
	</div>
</div>