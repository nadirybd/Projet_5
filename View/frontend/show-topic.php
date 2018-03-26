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
					<?php if($admin($user->id)): ?>
						<p><span class="admin">Administrateur <i class="fas fa-chess-king"></i></span></p>
					<?php endif; ?>
					<p><a href="<?= $url($user->pseudo); ?>"><?= htmlspecialchars($user->pseudo); ?></a></p>

			</aside>
			<div class="topic-content">
				<?php if($topic->t_edit_date !== "00/00/0000 à 00h00min00s"): ?>
					<p>Posté par <?= htmlspecialchars($user->pseudo); ?> le <?= $topic->date_topic; ?> ( Édité le <?= $topic->t_edit_date; ?> ) :</p>
				<?php else: ?>
					<p>Posté par <?= htmlspecialchars($user->pseudo); ?> le <?= $topic->date_topic; ?> :</p>
				<?php endif; ?>
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
						<?php if($admin($userMessages->id)): ?>
							<p><span class="admin">Administrateur <i class="fas fa-chess-king"></i></span></p>
						<?php endif; ?>
						<p><a href="<?= $url($userMessages->pseudo); ?>"><?= htmlspecialchars($userMessages->pseudo); ?></a></p>
				</aside>

				<div class="topic-content">
					<?php if($comment->edit_dateFr !== "00/00/0000 à 00h00min00s"): ?>
						<p>
							Posté par <?= htmlspecialchars($userMessages->pseudo); ?> le <?= $comment->messageDate; ?> ( Édité le : <?= $comment->edit_dateFr; ?> ) : 
						</p>
					<?php else: ?>
						<p>
							Posté par <?= htmlspecialchars($userMessages->pseudo); ?> le <?= $comment->messageDate; ?> :
						</p>
					<?php endif; ?>
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
								<button type="submit" class="btn-validate" name="sub_bestAnswer"><i class="fas fa-heart"></i></button> 
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