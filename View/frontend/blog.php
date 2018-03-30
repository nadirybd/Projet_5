<div class="page front-page" id="blog-page" style="text-align: center;">
	<h1>BLOG</h1>
	<?php foreach($posts as $post): ?>
	<div>
		<div><img src="public/images/posts/<?= $post->post_img; ?>" width="350" alt="image du blog"/></div>
		<h3><?= htmlspecialchars($post->post_title); ?></h3>
		<p><?= strip_tags(substr($post->post_content, 0, 300)); ?> ... <a href="">voir la suite</a></p>
	</div>
	<?php endforeach; ?>
</div>