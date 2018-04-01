<div class="page front-page" id="blog-page" style="text-align: center;">
	<h1>Retrouvez tous nos articles</h1>
	<div id="all-posts">	
		<?php foreach($posts as $post): ?>
		<div class="post-ticket">
			<div class="blog-img"><a href="post/<?= $post->id; ?>"><img src="public/images/posts/thumbs/thumb_<?= $post->post_img; ?>" width="350" alt="image du blog"/></a></div>
			<div class="ticket-content">
				<h2><a href="post/<?= $post->id; ?>"><?= htmlspecialchars($post->post_title); ?></a></h2>
				<p><?= strip_tags(substr($post->post_content, 0, 300)); ?> ... <a href="post/<?= $post->id; ?>">voir la suite</a></p>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="pagination"><?= $pagination; ?></div>
</div>