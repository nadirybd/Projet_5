<div id="one-topic-page" class="page">
	<h1>Sujet : <?= strip_tags($topic->title); ?></h1>
	<section>
		<aside class="avatar-topic">
				<p><a href="<?= $url($user->pseudo); ?>"><img src="View/backend/users/avatars/<?= $user->avatar; ?>" /></a></p>
				<p><a href="<?= $url($user->pseudo); ?>"><?= htmlspecialchars($user->pseudo); ?></a></p>
		</aside>
		<div class="topic-content">
			<p>Posté par <?= htmlspecialchars($user->pseudo); ?> le <?= $topic->date_topic; ?> :</p>
			<div class="topic-text"><?= htmlspecialchars($topic->content); ?></div>	
		</div>
	</section>
	<section>
		<aside class="avatar-topic">
		
		</aside>
		<div class="topic-content">
			<p><span class="date_topic">Posté par Username le </span> :</p>
			<div class="topic-text"></div>	
		</div>
	</section>

	<div id="comment-form-topic">
		<?php if(isset($_SESSION['user']['id'])): ?>
			<form class="form comment-fom" method="post">
				<p>Ajoutez un commentaire : </p>
				<textarea name="comment-topic"></textarea>
				<p><input type="submit" name="submit-comment" value="Répondre" /></p>	
			</form>
		<?php else: ?>
			<div>
				Veuillez vous connectez pour y répondre : <a href="login">Connectez vous !</a> <br /> Toujours pas de compte ? <a href="subcribe">Inscrivez-vous</a>
			</div>
		<?php endif; ?>
	</div>
</div>