<div id="topics-page" class="page">
	<section>
		<?php foreach($topics as $topic): ?>
			<div class="row-topics">
				<aside>
					<p><img src="public/images/icons/categories/1.png" alt="png programmation" width="150" /></p>
				</aside>
				<div class="topics">
					<h2><a href=""><?= $topic->title; ?></a></h2>
					<p><?= $topic->content; ?></p>
					<p> Date de création du topic : <?= $topic->date_topic; ?></p>
					<p>Créer par : Username</p>
				</div>
			</div>
			<hr/>
		<?php endforeach; ?>
		<!-- <p><?= $pagination; ?> </p> --> 
	</section>
</div>