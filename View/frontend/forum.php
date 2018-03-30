<div class="page front-page" id="forum-page">
	<div class="banner"></div>
	<div id="forum-container">
		<div id="categories-container">
			<h2>FORUM</h2>
			<?php foreach($categories as $category): ?>
				<div class="row-category">
					<aside>
						<p><img src="public/images/icons/categories/<?= $category->logo; ?>" alt="png programmation" width="130" /></p>
					</aside>
					<div class="category">
						<h3><a href="<?= $url($category->name, $category->id); ?>-1"><?= htmlspecialchars($category->name); ?></a></h3>
						<div class="sub">
							<p><?= $subcat($category->id, $category->id, $category->name); ?></p>
						</div>
						<p>Nombre de topics posté : <?= $nbTopics($category->id); ?></p>
					</div>
				</div>
				<hr/>
			<?php endforeach; ?>
		</div>

		<aside id="side-forum">
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

			<table class="tb" id="tb-last-chat">
				<thead>
					<tr>
						<th><i class="fas fa-comments"></i> MINI CHAT <i class="fas fa-caret-up"></i></th>
					</tr>
				</thead>
				<tbody id="chat-container">
				<?php foreach ($allChat as $chat): ?>
				<?php $userChat = $user($chat->user_id); ?>
					<tr>
						<td>
						<?php if(!empty($userChat->pseudo)): ?>
							<span class="user_chat"><?= htmlspecialchars($userChat->pseudo); ?></span> à <?= $chat->chat_dateFr; ?> : <?= htmlspecialchars($chat->chat_content); ?>
						<?php else: ?>
							<span class="user_chat">Anonyme</span> à <?= $chat->chat_dateFr; ?> : <?= htmlspecialchars($chat->chat_content); ?>
						<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
				<tfoot>
					<?php if(isset($_SESSION['user'])): ?>
					<tr>
						<td>
							<form method="post" class="form" id="chat-form">
								<p><input type="text" name="text_chat" autocomplete="off"></p>
								<input type="submit" name="sub-chat" value="Répondre">
							</form>
						</td>
					</tr>
					<?php else: ?>
					<tr>
						<td>
							Veuillez vous <a href="login"><strong>connectez</strong></a> pour discuter
						</td>
					</tr> 
					<?php endif; ?>
				</tfoot>
			</table>
		</aside>
	</div>
</div>

<script src="public/js/chat.js"></script>
<script src="public/js/forum/main-forum.js"></script>