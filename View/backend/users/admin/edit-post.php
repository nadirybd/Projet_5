<div class="page form-page" id="edit-message">
	<div class="form-container">
		
		<h1>Editer l'article</h1>

		<form class="form" method="post" enctype="multipart/form-data">
			<?php if(isset($error_edit)): ?>
				<div class="error"><?= $error_edit; ?></div>
			<?php endif; ?>
			<p>
				<label for="edit_img_post"><img src="public/images/posts/thumbs/thumb_<?= $post->post_img; ?>"></label><br />
				<input type="file" name="edit_img_post" id="edit_img_post" />
			</p>
			<p>
				<label for="edit_title_post">Titre de l'article</label><br />
				<input type="text" name="edit_title_post" id="edit_title_post" value="<?= $post->post_title; ?>"/>
			</p>
			<p>
				<textarea name="edit_content_post" id="mytinymce"><?= htmlspecialchars($post->post_content); ?></textarea>
			</p>
			<p>
				<input type="submit" name="sub-edit-posts" value="Mettre à jour" />
			</p>
		</form>	

		<p><a href="admin/list-posts-1">Retourner à la liste des articles</a></p>
	</div>

</div>