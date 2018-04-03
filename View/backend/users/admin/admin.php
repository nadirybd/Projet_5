<div class="page admin-page">
	<div class="admin-container">
		<div class="side-admin">
			<h1>Administration <i class="fas fa-chess-king"></i></h1>
			<fieldset>
				<legend>Gestionnaire du blog</legend>
				<p><a href="admin/add-post">Ajouter un nouvel article</a></p>
				<p><a href="admin/list-posts-1">Modifier un article</a></p>
			</fieldset><br/>
			<fieldset>
				<legend>Gestionnaire des événements</legend>
				<p><a href="admin/add-event">Ajouter un événements</a></p>
				<p><a href="admin/list-events-1">Modifier un événement</a></p>
			</fieldset>
		</div>
		<div class="admin-content">
			<h2>GESTIONNAIRE DU FORUM</h2>
			<div id="admin-last-info">
				<div id="last-topics">
					<h3>Liste des 10 derniers topics</h3>	
					<div id="last-topics-content">
					<?php foreach ($lastTopics as $lastTopic): ?>
						<div class="admin-list">
							<p><a href="topic/webmastertopic-<?= $lastTopic->id; ?>-1"><?= htmlspecialchars($lastTopic->title); ?></a></p>
							<p><a href="admin/delete-topic-<?= $lastTopic->id; ?>"><span class="delete">Supprimer</span></a></p>
						</div>
						<hr/>
					<?php endforeach; ?>
					</div>
				</div>
				<div id="reported-comment">	
					<h3>Les commentaires signalés</h3>
					<div id="report-msg-content">					
					<?php foreach ($reportedMessages as $r_message): ?>
						<?php $r_user = $userMessages($r_message->user_id); ?>
						<div class="admin-list">
							<p>Utilisateur : <?= htmlspecialchars($r_user->pseudo); ?></p>
							<p>Nombre de report : <?= $r_message->report; ?></p>
							<div class="content-report-msg"><?= htmlspecialchars($r_message->content); ?></div>

							<form class="form" method="post">
								<input type="hidden" name="pull_report" value="<?= $r_message->id; ?>" />
								<p>
									<button class="btn btn-validate" type="submit" name="sub-pull-report">Approuver</button>
									<button class="btn btn-delete" onclick="window.location.href='admin/delete-message-<?= $r_message->id; ?>'" type="button">
										Supprimer
									</button>
								</p>
							</form>
						</div>
						<hr/>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div id="admin-forum-user">
				<div id="user-container">
					<div id="last-users-content">
						<h3>LES 10 DERNIERS UTILISATEURS INSCRITS</h3>	
						<ul>
						<?php foreach ($lastUsers as $lastUser): ?>
							<li><a href="public-profile/-<?= $lastTopic->pseudo; ?>"><?= htmlspecialchars($lastUser->pseudo); ?></a></li>
							<hr/>
						<?php endforeach; ?>
						</ul>
					</div>
					<form class="form" id="delete-user-form" method="post">
						<?php if(isset($success_delete_user)): ?>
							<div class="succes"><?= $success_delete_user; ?></div>
						<?php endif; ?>
						<p>
							<label>Supprimer un utilisateur :</label><br/>
							<input type="text" name="delete_user" placeholder="Entrez le pseudo de l'utilisateur" />
						</p>
							<input type="submit" name="sub-delete-user" value="Bannir">
					</form>
				</div>
			</div>
		</div>	
	</div>
</div>