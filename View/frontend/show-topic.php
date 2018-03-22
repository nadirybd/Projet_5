<div id="one-topic-page" class="page">
	<h1><?= strip_tags($topic->title); ?></h1>
	<section>
		<aside>Ici l'image</aside>
		<div class="topic-content">
			<p><span class="date_topic">Posté par Username le <?= $topic->date_topic; ?></span> :</p>
			<div class="topic-text"><?= htmlspecialchars($topic->content); ?></div>	
		</div>
	</section>
	<section>
		<aside>Ici l'image</aside>
		<div class="topic-content">
			<p><span class="date_topic">Posté par Username le </span> :</p>
			<div class="topic-text"></div>	
		</div>
	</section>
</div>