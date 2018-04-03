<div class="page admin-page">
	<div class="admin-container">
		<div class="side-admin">
			<h1>Administration <i class="fas fa-chess-king"></i></h1>
			<fieldset>
				<legend>Gestionnaire des événements</legend>
				<p><a href="admin/add-event">Ajouter un événement</a></p>
				<p><a href="admin">Retourner à l'administration du forum</a></p>
			</fieldset>
		</div>
		<div class="admin-content">
			<h2>GESTIONNAIRE DES ÉVÉNEMENTS</h2>
			<div class="list-posts">			
				<table class="tb">
					<thead>
						<tr>
							<td>Titre de l'article</td>
							<td>Option</td>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($events as $event): ?>
						<tr>
							<td><?= htmlspecialchars($event->title); ?></td>
							<td>
								<button class="btn btn-validate" onclick="window.location.href='admin/edit-event-<?= $event->id; ?>'">Editer</button>
								<button class="btn btn-cancel" onclick="window.location.href='admin/delete-event-<?= $event->id; ?>'">Supprimer</button>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
				<p><?= $pagination; ?></p>
			</div>
		</div>	
	</div>
</div>