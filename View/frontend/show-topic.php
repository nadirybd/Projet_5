<div id="one-topic-page" class="page">
	<?php if($topic->resolved == 1): ?>
		<h1>Sujet : <?= strip_tags($topic->title); ?> - <span class="resolved">Résolu <i class="fas fa-check"></i></span></h1>
	<?php else: ?>
		<h1>Sujet : <?= strip_tags($topic->title); ?></h1>
	<?php endif; ?>
	<?php if($_GET['page'] == 1): ?>
		<section>
			<aside class="avatar-topic">
					<p><a href="<?= $url($user->pseudo); ?>"><img src="View/backend/users/avatars/<?= $user->avatar; ?>" /></a></p>
					<p><a href="<?= $url($user->pseudo); ?>"><?= htmlspecialchars($user->pseudo); ?></a></p>
			</aside>
			<div class="topic-content">
				<p>Posté par <?= htmlspecialchars($user->pseudo); ?> le <?= $topic->date_topic; ?> :</p>
				<hr/>
				<div class="topic-text"><?= htmlspecialchars($topic->content); ?></div>	
			</div>
		</section>
	<?php endif; ?>

	<?php if(count($comment) > 0): ?> 
		<?php foreach($comment as $comment): ?>
			<section>		
				<?php $userMessages = $userComment($comment->user_id); ?>
				<aside class="avatar-topic">
						<p><a href="<?= $urlComment($userMessages->pseudo); ?>"><img src="View/backend/users/avatars/<?= $userMessages->avatar; ?>" /></a></p>
						<p><a href="<?= $url($userMessages->pseudo); ?>"><?= htmlspecialchars($userMessages->pseudo); ?></a></p>
				</aside>

				<div class="topic-content">
					<p>
						Posté par <?= htmlspecialchars($userMessages->pseudo); ?> le <?= $comment->messageDate; ?> :
					</p>
					<hr/>

					<div class="topic-text"><?= htmlspecialchars($comment->content); ?></div>

					<?php if(isset($_SESSION['user']['id'])): ?>
						<?php if($userMessages->id == $_SESSION['user']['id']): ?>

							<div class="edit">
								<a href="edit-message-<?= $comment->id; ?>">Editer votre commentaire</a>
							</div>

						<?php elseif($topic->user_id == $_SESSION['user']['id'] && $comment->best_answer == 0 && $comment->user_id !== $_SESSION['user']['id']): ?>
							<form class="form best-answer-form" method="post">
								<input type="hidden" name="best_answer" value="<?= $comment->id; ?>" />
								<input type="submit" name="sub_bestAnswer" value="J'aime la réponse" /> 
							</form>
						<?php endif; ?>
					<?php endif; ?>

					<?php if($comment->best_answer == 1): ?>
						<div class="best_answer">
							<span class="resolved">Meilleure réponse ! <i class="fas fa-check"></i></span>
						</div>
					<?php endif; ?>
				</div>
			</section>
		<?php endforeach; ?>
	<?php endif; ?>

	<p><?= $pagination; ?></p>
	
	<div id="comment-form-topic">
		<?php if(isset($_SESSION['user']['id'])): ?>
			<form class="form comment-fom" method="post">
				<p>Ajoutez un commentaire : </p>
				<textarea name="comment-topic"></textarea>
				<p><input type="submit" name="submit-comment" value="Répondre" /></p>	
			</form>
		<?php else: ?>
			<div>
				Veuillez vous connectez pour y répondre : <a href="login">Connectez vous !</a> <br /> Toujours pas de compte ? <a href="subscribe">Inscrivez-vous</a>
			</div>
		<?php endif; ?>
	</div>
</div>