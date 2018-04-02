<div id="search-page" class="page front-page">
	<section>
		<table class="tb tb-topics-cat">
			<thead>
				<tr>
					<td>Sujet</td>
					<td>Auteur</td>
					<td>Date de création</td>
					<td>Status</td>
					<?php if(isset($_SESSION['admin'])): ?>
						<td>Option</td>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($topics)): ?>
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
							<?= $topic->date_topic; ?>
						</td>
						<td>
							<?php if($topic->resolved == 1): ?>
								<span class="resolved">Résolu <i class="fas fa-check"></i></span><br/>
							<?php else: ?>
								Non résolu<br/>
							<?php endif; ?>
							<?php if($topic->closed == 1): ?>
								<span class="delete">Fermé</span>
							<?php endif; ?>
						</td>
						<?php if(isset($_SESSION['admin'])): ?>
							<td>
								<p>								
									<button class="btn btn-delete" onclick="window.location.href='admin/delete-topic-<?= $topic->id; ?>'">
										Supprimer
									</button>
								</p>
								<?php if($topic->closed == 0): ?>
									<p>
										<button class="btn btn-cancel" onclick="window.location.href='admin/close-topic-<?= $topic->id; ?>'">
										Clore le sujet
										</button>
									</p>
								<?php endif; ?>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<?php if(isset($_SESSION['admin'])): ?>
						<td colspan="5">Aucun résultat pour votre recherche : <?= $_POST['req']; ?></td>
					<?php else: ?>
						<td colspan="4">Aucun résultat pour votre recherche : <?= $_POST['req']; ?></td>
					<?php endif; ?>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</section>
</div>
