<div id="home-page">
	<div id="slider">
		<div id="slider-content">
			<h2>Partagez votre expérience, ou bien même trouvez des solutions et devenez expérimentés !</h2>
			<p>
				<?php if(isset($_SESSION['user'])): ?>
					<button class="call-to-action"><a href="profile">VOTRE PROFIL</a></button>
				<?php else : ?>
					<button class="call-to-action"><a href="login">SE CONNECTER</a></button>
					<button class="call-to-action"><a href="subscribe">S'INSCRIRE</a></button>
				<?php endif; ?>
			</p>
		</div>
	</div>

	<section class="widget-container wd-container-1">
		<div class="widget wd-1">
			<div class="icon-widget"><i class="fas fa-newspaper fa-3x"></i></div>
			<p>Retrouver toutes les actualités</p>
			<button class="call-to-action"><a href="#">VOIR L'ACTUALITÉ</a></button>
		</div>
		<div class="widget wd-2">
			<div class="icon-widget"><i class="fas fa-globe fa-3x"></i></div>
			<p>Besoin d'aide ? Allez-y voir le forum !</p>
			<button class="call-to-action"><a href="webmaster-forum">FORUM</a></button>
		</div>
		<div class="widget wd-3">
			<div class="icon-widget"><i class="fas fa-phone fa-3x"></i></div>
			<p>Pour toutes autres informations complémentaires : Contactez-nous !</p>
			<button class="call-to-action"><a href="#">NOUS CONTACTER</a></button>
		</div>
	</section>

	<section class="widget-container wd-container-2">
		<div class="widget wd-4">
			<div id="last-topic">
			<h3>Le dernier topic posté</h3>
				<h4><a href=""><?= $lastTopic->title; ?></a></h4>
				<p><?= strip_tags(substr($lastTopic->content, 0,500)); ?> ...</p>
				<p><span class="date"><?= $lastTopic->date_fr; ?></span></p>
			</div>
		</div>
	</section>
</div>