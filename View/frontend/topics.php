<div id="topics-page" class="page">
	<section>
		<table class="tb tb-topics-cat">
			<thead>
				<tr>
					<td>Sujet</td>
					<td>Auteur</td>
					<td>Date de création</td>
					<td>Status</td>
					<?php if(isset($_SESSION['user'])): ?>
						<td>Option</td>
					<?php endif; ?>
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
					<?php if(isset($_SESSION['user'])): ?>
						<?php if($followed($topic->id) == 1): ?>
						<td>
							<form method="post">
								<input type="hidden" name="unfollow" value="<?= $topic->id; ?>" />
								<button class="btn-cancel" type="submit" name="sub-unfollow">Ne plus suivre</button>
							</form>
						</td>
						<?php else: ?>
						<td>
							<form method="post">
								<input type="hidden" name="follow" value="<?= $topic->id; ?>" />
								<button class="btn-validate" type="submit" name="sub-follow">Suivre</button>
							</form>
						</td>
						<?php endif; ?>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p><?= $pagination; ?> </p>
	</section>
</div>
