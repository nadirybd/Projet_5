<div class="page front-page">
	<h1><?= htmlspecialchars($post->post_title); ?></h1>
	<div><img src="public/images/posts/<?= $post->post_img; ?>" width="550" alt="image du blog"/></div>
	<p><?= $post->post_content; ?></p>
</div>