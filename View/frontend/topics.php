<div id="topics-page" class="page">
	<section>
		<?php foreach($topics as $topic): ?>
			<div class="row-topics">
				<aside>
					<p><img src="public/images/icons/categories/1.png" alt="png programmation" width="150" /></p>
				</aside>
				<div class="topics">
					<?php if($topic->resolved == 1): ?>
						<h2>
							<a href="topic/webmastertopic-<?= $topic->id; ?>-1"><?= strip_tags($topic->title); ?></a> - <span class="resolved">Résolu <i class="fas fa-check"></i></span>
						</h2>
					<?php else: ?>
						<h2><a href="topic/webmastertopic-<?= $topic->id; ?>-1"><?= strip_tags($topic->title); ?></a></h2>
					<?php endif; ?>
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