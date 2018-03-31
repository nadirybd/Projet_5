<div class="page" id="profile-page">
	<div id="profile-content">
		<div id="profile-info">
			<div id="bar-info">
				<aside class="avatar">
					<p><img src="View/backend/users/avatars/<?= $user->avatar; ?>" /></p>
				</aside>
				<div class="user-info">
					<p><a href="edit-avatar">Modifier l'avatar</a></p>
					<h3>Vos informations <a href="edit-profile"><i class="fas fa-edit"></i></a></h3>
					<p><i class="fas fa-user"></i> <?= htmlspecialchars($user->pseudo); ?></p>
					<p><i class="fas fa-envelope"></i> <?= $user->mail; ?></p>
					<p><i class="fas fa-calendar-alt"></i> Date d'inscription : <?= $_SESSION['user']['date']; ?></p>
				</div>
			</div>

			<section id="profile-description">
				<h3>À Propos de vous - <a><i class="fas fa-edit edit-button"></i></a></h3>
				<?php if(!empty($infoUser->description)): ?>
					<div class="description-content"><?= htmlspecialchars($infoUser->description); ?></div>
				<?php else: ?>
					<div class="description-content">Aucune description</div>
				<?php endif; ?>
				<div id="description-container">
					<form class="form" method="post">
						<?php if(isset($description_error)): ?>
							<div class="error">
								<?= $description_error; ?>
							</div>
						<?php endif; ?>
						<?php if(!empty($infoUser->description)): ?>
							<textarea class="text-edit" name="edit_description"> <?= htmlspecialchars($infoUser->description);  ?></textarea>
						<?php else: ?>
							<textarea class="text-edit" name="edit_description"></textarea>
						<?php endif; ?>
						<p>
							<input type="submit" name="sub_description" />
							<button class="btn-cancel cancel-description" type="button">Annuler</button>
						</p>
					</form>
				</div>

				<div id="all-profile-topics">
					<table class="tb" id="tb-created-topics">
					<thead>
						<tr>
							<td>Vos topics créés</td>
							<td>Nombre de réponse</td>
							<td>Status</td>
							<td>Option</td>
						</tr>
					</thead>
					<tbody>
						<?php if(empty($topics)): ?>
							<tr>
								<td colspan="4">Vous n'avez créé aucun topic</td>
							</tr>
						<?php else: ?>
						<?php foreach ($topics as $topic): ?>
							<tr>
								<td><a href="topic/webmastertopic-<?= $topic->id; ?>-1"><?= $topic->title; ?></a></td>
								<td><?= $messages($topic->id); ?></td>
								<td>
									<?php if($topic->resolved == 1): ?>
										<span class="resolved">Résolu <i class="fas fa-check"></i></span>
									<?php else: ?>
										<span class="no-resolved">Non résolu</span>
									<?php endif; ?>
								</td>
								<td>
									<a href="edit-topic-<?= $topic->id; ?>">Editer</a><a href="delete-topic-<?= $topic->id; ?>">
										<span class="delete">Supprimer</span>
									</a>
								</td>
							</tr>	
						<?php endforeach ?>
						<?php endif; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4"><button class="resolved-button btn-validate">Résolu</button></td>
						</tr>
					</tfoot>
				</table>

				<table class="tb" id="tb-followed-topics">
					<thead>
						<tr>
							<td>Les topics suivis</td>
							<td>Status</td>
							<td>Option</td>
						</tr>
					</thead>
					<tbody>
						<?php if(empty($topicsFollowed)): ?>
							<tr>
								<td colspan="3">Vous ne suivez aucun topic pour le moment</td>
							</tr>
						<?php else: ?>
						<?php foreach ($topicsFollowed as $topicF): ?>
							<tr>
								<td>
									<a href="topic/webmastertopic-<?= $topicF->id; ?>-1"><?= $topicF->title; ?></a>
								</td>
								<td>
									<?php if($topicF->resolved == 1): ?>
										<span class="resolved">Résolu <i class="fas fa-check"></i></span>
									<?php else: ?>
										<span class="no-resolved">Non résolu</span>
									<?php endif; ?>
								</td>
								<td>
									<form method="post">
										<input type="hidden" name="unfollow" value="<?= $topicF->id; ?>" />
										<button class="btn-cancel" type="submit" name="sub-unfollow">Ne plus suivre</button>
									</form>
								</td>
							</tr>	
						<?php endforeach ?>
						<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3"></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</section>
		</div>

		<?php if(!empty($topics)): ?>
			<div id="resolved-form">
				<span class="close"><i class="fas fa-times"></i></span>
				<p>Un topic est résolu ?</p>
				<?php if(isset($resolved_errors)): ?>
					<div class="error"><?=$resolved_errors; ?></div><br />
				<?php endif; ?>
				<form class="form" method="post">
					<select name="resolved">
						<option>Veuillez sélectionner un topic</option>
						<?php foreach ($topics as $topic): ?>
						<?php if($topic->resolved == 0): ?>
							<option value="<?= $topic->id; ?>">
								<?= $topic->title; ?>
							</option>
						<?php endif; ?>
						<?php endforeach; ?>
					</select>
					<p><input type="submit" name="sub-resolved" value="Marquer comme résolu"></p>
				</form>
			</div>
		<?php endif; ?>

		
	</div>
</div>

<script src="public/js/form/form-profile.js"></script>