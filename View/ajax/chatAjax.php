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
