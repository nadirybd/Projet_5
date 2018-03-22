<div id="topics-page" class="page">
	<section>
		<?php foreach($topics as $topic): ?>
			<div class="row-topics">
				<aside>
					<p><img src="public/images/icons/categories/1.png" alt="png programmation" width="150" /></p>
				</aside>
				<div class="topics">
					<h2><a href="topic/webmastertopic-<?= $topic->id; ?>"><?= strip_tags($topic->title); ?></a></h2>
					<p><?= strip_tags(substr($topic->content, 0, 200)); ?></p>
					<p> Date de création du topic : <?= $topic->date_topic; ?></p>
					<p>Créer par : <?= htmlspecialchars($user($topic->user_id)); ?></p>
				</div>
			</div>
			<hr/>
		<?php endforeach; ?>
		<p><?= $pagination; ?> </p>
	</section>
</div>