<div class="page front-page" id="forum-page">
	
	<div id="categories-container">
		<h1>FORUM</h1>
		<?php foreach($categories as $category): ?>
			<div class="row-category">
				<aside>
					<p><img src="public/images/icons/categories/<?= $category->logo; ?>" alt="png programmation" width="130" /></p>
				</aside>
				<div class="category">
					<h2><a href="<?= $url($category->name, $category->id); ?>-1"><?= htmlspecialchars($category->name); ?></a></h2>
					<div class="sub">
						<p><?= $subcat($category->id, $category->id, $category->name); ?></p>
					</div>
					<p> Nombre de topics posté : <?= $nbTopics($category->id); ?></p>
				</div>
			</div>
			<hr/>
		<?php endforeach; ?>
	</div>

	<aside id="side-forum">
		<div id="carousel">
			<ul class="carousel-container">
				<li class="carousel-img"><img src="public/images/icons/programmation/html.png" alt="logo programmation"></li>
				<li class="carousel-img"><img src="public/images/icons/programmation/css.png" alt="logo programmation"></li>
				<li class="carousel-img"><img src="public/images/icons/programmation/js.png" alt="logo programmation"></li>
				<li class="carousel-img"><img src="public/images/icons/programmation/php.png" alt="logo programmation"></li>
				<li class="carousel-img"><img src="public/images/icons/programmation/sql.png" alt="logo programmation"></li>
				<li class="carousel-img"><img src="public/images/icons/programmation/java.png" alt="logo programmation"></li>
				<li class="carousel-img"><img src="public/images/icons/programmation/python.png" alt="logo programmation"></li>
				<li class="carousel-img"><img src="public/images/icons/programmation/ruby.png" alt="logo programmation"></li>
			</ul>
		</div>
		<table class="tb" id="tb-last-topics">
			<thead>
				<tr>
					<th>LES 5 DERNIERS TOPICS <i class="fas fa-caret-up"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($lastTopics as $lastTopic): ?>
				<tr>
					<td>
						<h3><a href="topic/webmastertopic-<?= $lastTopic->id; ?>-1"><?= htmlspecialchars($lastTopic->title); ?></a></h3>
						<p><?= htmlspecialchars(substr($lastTopic->content, 0, 150)); ?> ...</p>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td><a href="topics/1">Voir tous les topics</a></td>
				</tr>
			</tfoot>
		</table>
	</aside>
</div>


<script src="public/js/forum/main-forum.js"></script>
<script src="public/js/forum/slider.js"></script>