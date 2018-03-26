<div class="page">
	<h1>Administration</h1>
	<div id="last-topics" style="max-width: 500px;">	
		<?php foreach ($lastTopics as $lastTopic): ?>
			<div>
				<?= $lastTopic->title; ?>
				<a href="delete-<?= $lastTopic->id; ?>"><span class="delete">Supprimer</span></a>
			</div>
			<hr/>
		<?php endforeach; ?>
	</div>
</div>