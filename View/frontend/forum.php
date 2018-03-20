<div class="page">
	<div id="forum-page">
		<section>
			<?php foreach($categories as $category): ?>
				<div class="row-category">
					<aside>
						<p><img src="public/images/icons/categories/programmation.png" alt="png programmation" width="150" /></p>
					</aside>
					<div class="category">
						<h2><a href=""><?= $category->name; ?></a></h2>
						<p><?= $subcat([$category->id], $category->id); ?></p>
						<p>Nombre de topics</p>
						<p>Dernier topics</p>
					</div>
				</div>
			<?php endforeach; ?>
		</section>

		<aside id="side-info">
			<table class="tb tb-last-topics">
				<thead>
					<tr>
						<th>DERNIER TOPICS</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Itaque earum rerum hic tenetur a sapiente delectus. Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</td>
					</tr>
					<tr>
						<td>Do eiusmod tempor incididunt ut labore et dolore magna aliqua. At vero eos et accusamus. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</td>
					</tr>
					<tr>
						<td>Itaque earum rerum hic tenetur a sapiente delectus. Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</td>
					</tr>
					<tr>
						<td>Do eiusmod tempor incididunt ut labore et dolore magna aliqua. At vero eos et accusamus. Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</td>
					</tr>
				</tbody>
			</table>

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
			</table>
		</aside>
	</div>
</div>