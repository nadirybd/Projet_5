<div id="forum-page" class="page frontpage">
	<section>
		<?php foreach($categories as $category): ?>
			<div class="row-category">
				<aside>
					<p><img src="public/images/icons/categories/<?= $category->logo; ?>" alt="png programmation" width="150" /></p>
				</aside>
				<div class="category">
					<h2><a href=""><?= $category->name; ?></a></h2>
					<p><?= $subcat($category->id, $category->id); ?></p>
					<p> Le nombre de topics de cette catégorie : <?= $nbTopics($category->id); ?></p>
					<p>Le dernier topic de cette catégorie</p>
				</div>
			</div>
			<hr/>
		<?php endforeach; ?>
	</section>

	<aside id="side-tb">
		<table class="tb tb-last-topics">
			<thead>
				<tr>
					<th>DERNIERS TOPICS</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($lastTopics as $lastTopic): ?>
				<tr>
					<td>
						<h3><a href=""><?= htmlspecialchars($lastTopic->title); ?></a></h3>
						<p><?= htmlspecialchars(substr($lastTopic->content, 0, 150)); ?> ...</p>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td><a href="topics">Voir tous les topics</a></td>
				</tr>
			</tfoot>
		</table>

		<vr/>
		<table class="tb tb-last-posts">
			<thead>
				<tr>
					<th>DERNIERS POSTS</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Do eiusmod tempor incididunt ut labore et dolore magna aliqua. At vero eos et accusamus. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</td>
				</tr>
				<tr>
					<td>Itaque earum rerum hic tenetur a sapiente delectus. Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</td>
				</tr>
				<tr>
					<td> Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</td>
				</tr>
				<tr>
					<td>. Cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia. Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td><a href="">Voir tous les posts</a></td>
				</tr>
			</tfoot>
		</table>
	</aside>
</div>

