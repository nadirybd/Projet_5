<div id="topics-page" class="page">
	<section>
		<table class="tb tb-topics-cat">
			<thead>
				<tr>
					<td>Sujet</td>
					<td>Auteur</td>
					<td>Date de création</td>
					<td>Status</td>
					<td>Suivre un topic</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach($topics as $topic): ?>
				<tr>
					<td>
						<h3><a href="topic/webmastertopic-<?= $topic->id; ?>-1"><?= strip_tags($topic->title); ?></a></h3>
						<p><?= strip_tags(substr($topic->content, 0, 200)); ?></p>
					</td>
					<td>
						<?= htmlspecialchars($user($topic->user_id)); ?>
					</td>
					<td>
						Date de création du topic : <?= $topic->date_topic; ?>
					</td>
					<td>
						<?php if($topic->resolved == 1): ?>
							<span class="resolved">Résolu <i class="fas fa-check"></i></span>
						<?php else: ?>
							Non résolu
						<?php endif; ?>
					</td>
					<td>
						<button class="validate">Suivre</button>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p><?= $pagination; ?> </p>
	</section>
</div>