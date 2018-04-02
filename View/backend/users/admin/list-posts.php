<div class="page" id="admin-page">
	<div id="admin-container">
		<div class="side-admin">
			<h1>Administration <i class="fas fa-chess-king"></i></h1>
			<fieldset>
				<legend>Gestionnaire du blog</legend>
				<p><a href="admin/add-post">Ajouter un nouvel article</a></p>
				<p><a href="admin">Retourner à l'administration du forum</a></p>
			</fieldset>
		</div>
		<div id="admin-content">
			<h2>GESTIONNAIRE DU BLOG</h2>
			<div class="list-posts">			
				<table class="tb">
					<thead>
						<tr>
							<td>Titre de l'article</td>
							<td>Option</td>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($posts as $post): ?>
						<tr>
							<td><?= htmlspecialchars($post->post_title); ?></td>
							<td>
								<button class="btn btn-validate" onclick="window.location.href='admin/edit-post-<?= $post->id; ?>'">Editer</button>
								<button class="btn btn-cancel" onclick="window.location.href='admin/delete-post-<?= $post->id; ?>'">Supprimer</button>
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