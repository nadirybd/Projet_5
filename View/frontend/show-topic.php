<div id="topic-page" class="page">
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

	<?php if(!empty($comments)): ?> 
		<?php foreach($comments as $comment): ?>
			<section>		
				<?php $userMessages = $userComment($comment->user_id); ?>
				<aside class="avatar-topic">
					<p><a href="<?= $urlComment($userMessages->pseudo); ?>"><img src="View/backend/users/avatars/<?= $userMessages->avatar; ?>" /></a></p>

					<?php if($admin($userMessages->id)): ?>
						<p><span class="admin">Administrateur <i class="fas fa-chess-king"></i></span></p>
					<?php endif; ?>
					
					<p><a href="<?= $url($userMessages->pseudo); ?>"><?= htmlspecialchars($userMessages->pseudo); ?></a></p>
					
					<?php if(isset($_SESSION['admin'], $_SESSION['user'])): ?>
						<div class="delete-message">	
							<a href="admin/delete-message-<?= $comment->id; ?>"><span class="delete">Supprimer</span></a>
						</div>	
					<?php endif; ?>

					<?php if($topic->user_id == $_SESSION['user']['id'] && $comment->best_answer == 0 && $comment->user_id !== $_SESSION['user']['id']): ?>
						<form class="form best-answer-form" method="post">
							<input type="hidden" name="best_answer" value="<?= $comment->id; ?>" />
							<button type="submit" class="btn-like" name="sub_bestAnswer"><i class="fas fa-heart"></i></button> 
						</form>
					<?php endif; ?>
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
					

					<?php if(isset($_SESSION['user']['id']) && !empty($userMessages->id)): ?>			
					<div class="option-comment">
						<form class="form report-form" method="post">
							<input type="hidden" name="report_id" value="<?= $comment->id; ?>" id="report_id" />
							<button class="btn-report" type="submit" name="sub-report">
								<i class="fas fa-exclamation-circle"></i> Signaler
							</button>
						</form>

						<?php if($comment->user_id == $_SESSION['user']['id']): ?>
							<div class="edit">
								<a href="edit-message-<?= $comment->id; ?>" title="Editer le commentaire"><i class="fas fa-edit"></i> Éditer</a>
							</div>
						<?php endif; ?>							
					</div>
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

	<div class="pagination"><?= $pagination; ?></div>

	<div class="notif">
	</div>

	<div id="comment-form-topic">
		<?php if(isset($_SESSION['user']['id']) && $topic->closed == 0): ?>
			<form class="form comment-fom" method="post">
				<p>Ajoutez un commentaire : </p>
				<textarea name="comment-topic"></textarea>
				<p><input type="submit" name="submit-comment" value="Répondre" /></p>	
			</form>
		<?php elseif($topic->closed == 1): ?>
			<div>
				Le sujet a été fermé par l'administrateur <i class="fas fa-times-circle"></i>
			</div>
		<?php else: ?>
			<div>
				Veuillez vous connectez pour y répondre : <a href="login">Connectez vous !</a> <br /> Toujours pas de compte ? <a href="subscribe">Inscrivez-vous</a>
			</div>
		<?php endif; ?>
	</div>
</div>
<script src="public/js/ajax-report.js"></script>