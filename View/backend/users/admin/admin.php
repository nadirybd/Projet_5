<div class="page" id="admin-page">
	<div id="admin-container">
		<h1>Administration <i class="fas fa-chess-king"></i></h1>
		<div id="admin-content">		
			<div id="last-topics">
				<h2>Liste des 10 derniers topics</h2>	
				<div id="last-topics-content">
				<?php foreach ($lastTopics as $lastTopic): ?>
					<div class="admin-list">
						<p><a href="topic/webmastertopic-<?= $lastTopic->id; ?>-1"><?= $lastTopic->title; ?></a></p>
						<p><a href="admin/delete-topic-<?= $lastTopic->id; ?>"><span class="delete">Supprimer</span></a></p>
					</div>
					<hr/>
				<?php endforeach; ?>
				</div>
			</div>
			<div id="reported-comment">	
				<h2>Les commentaires signalés</h2>
				<div id="report-msg-content">					
				<?php foreach ($reportedMessages as $r_message): ?>
					<?php $r_user = $userMessages($r_message->user_id); ?>
					<div class="admin-list">
						<p>Utilisateur : <?= $r_user->pseudo; ?></p>
						<p>Nombre de report : <?= $r_message->report; ?></p>
						<div class="content-report-msg"><?= htmlspecialchars($r_message->content); ?></div>

						<form class="form" method="post">
							<input type="hidden" name="pull_report" value="<?= $r_message->id; ?>" />
							<p>
								<input type="submit" name="sub-pull-report" value="Approuver"/>
								<button class="btn-cancel" onclick="window.location.href='admin/delete-message-<?= $r_message->id; ?>'" type="button">
									Supprimer
								</button>
							</p>
						</form>
					</div>
					<hr/>
				<?php endforeach; ?>
				</div>
			</div>

			<div id="user-container">
				<div id="last-users-content">
					<h2>LES 10 DERNIERS UTILISATEURS INSCRITS</h2>	
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