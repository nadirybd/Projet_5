<div class="page front-page" id="blog-page" style="text-align: center;">
	<h1>BLOG</h1>
	<?php foreach($posts as $post): ?>
	<div>
		<div><a href="post/<?= $post->id; ?>"><img src="public/images/posts/<?= $post->post_img; ?>" width="350" alt="image du blog"/></a></div>
		<h2><a href="post/<?= $post->id; ?>"><?= htmlspecialchars($post->post_title); ?></a></h2>
		<p><?= strip_tags(substr($post->post_content, 0, 300)); ?> ... <a href="post/<?= $post->id; ?>">voir la suite</a></p>
	</div>
	<?php endforeach; ?>
</div>