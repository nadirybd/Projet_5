<div class="page front-page">
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
					<button class="btn-edit" onclick="window.location.href='admin/edit-post-<?= $post->id; ?>'">Editer</button>
					<button class="btn-cancel" onclick="window.location.href='admin/delete-post-<?= $post->id; ?>'">Supprimer</button>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<p><?= $pagination; ?></p>
</div>