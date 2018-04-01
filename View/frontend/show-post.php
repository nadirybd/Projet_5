<div class="page" id="show-post">
	<div id="one-post">
		<h1><?= htmlspecialchars($post->post_title); ?></h1>
		<div class="one-post-img"><img src="public/images/posts/<?= $post->post_img; ?>" alt="image du blog"/></div>
		<p><?= $post->post_content; ?></p>
	</div>
</div>