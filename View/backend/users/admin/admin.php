<div class="page">
	<h1>Administration</h1>
	<section style="display: flex; justify-content: space-around;">
		<div id="last-topics" style="max-width: 500px;">	
			<?php foreach ($lastTopics as $lastTopic): ?>
				<div>
					<?= $lastTopic->title; ?>
					<a href="admin/delete-topic-<?= $lastTopic->id; ?>"><span class="delete">Supprimer</span></a>
				</div>
				<hr/>
			<?php endforeach; ?>
		</div>

		<div id="reported-comment" style="max-width: 500px;">	
			<?php foreach ($reportedMessages as $r_message): ?>
				<?php $r_user = $userMessages($r_message->user_id); ?>
				<div>
					<p>
						<?= htmlspecialchars($r_message->content); ?>
					</p>
					<p>
						Nombre de report : <?= $r_message->report; ?>
					</p>
					<p>
						Utilisateur : <?= $r_user->pseudo; ?>
					</p>
					<a href="admin/delete-message-<?= $lastTopic->id; ?>"><span class="delete">Supprimer</span></a>
				</div>
				<hr/>
			<?php endforeach; ?>
		</div>
	</section>
</div>