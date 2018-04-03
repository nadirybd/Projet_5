<div id="home-page">
	<div id="slider">
		<div id="slider-content">
			<h2>Partagez votre expérience, ou bien même trouvez des solutions et devenez expérimentés !</h2>
		</div>
		<p>
			<?php if(isset($_SESSION['user'])): ?>
				<button class="call-to-action btn-action" onclick="window.location.href='profile'">VOTRE PROFIL</button>
			<?php else : ?>
				<button class="call-to-action btn-action" onclick="window.location.href='login'">SE CONNECTER</button>
				<button class="call-to-action btn-action" onclick="window.location.href='subscribe'">S'INSCRIRE</button>
			<?php endif; ?>
		</p>
	</div>

	<section class="widget-container wd-container-1">
		<div class="widget wd-1">
			<div class="icon-widget"><i class="fas fa-newspaper fa-3x"></i></div>
			<p>Retrouver tous nos articles !</p>
			<button class="call-to-action" onclick="window.location.href='blog-1'">NOS ARTICLES</button>
		</div>
		<div class="widget wd-2">
			<div class="icon-widget"><i class="fas fa-globe fa-3x"></i></div>
			<p>Besoin d'aide ? Allez-y voir le forum !</p>
			<button class="call-to-action" onclick="window.location.href='webmaster-forum'">FORUM</button>
		</div>
		<div class="widget wd-3">
			<div class="icon-widget"><i class="fas fa-calendar-alt fa-3x"></i></div>
			<p>les événements organisés par la team Webmaster Forum ! </p>
			<button class="call-to-action" onclick="window.location.href='events'">Événements</button>
		</div>
	</section>

	<section class="widget-container wd-container-3">
		<div class="widget wd-5">
			<h2>Échangez sur différents langages ! </h2>
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
		</div>
	</section>

	<section class="widget-container wd-container-2">
		<div class="widget wd-4">
			<div id="last-topic">
				<h2>Le dernier topic posté </h2>
				<div id="last-topic-content">				
					<h3><a href="topic/webmastertopic-<?= $lastTopic->id; ?>-1"><?= htmlspecialchars($lastTopic->title); ?></a></h3>
					<p><?= htmlspecialchars(strip_tags(substr($lastTopic->content, 0,500))); ?> ...</p>
					<p><span class="date"><?= $lastTopic->date_fr; ?></span></p>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="public/js/home/slider.js"></script>