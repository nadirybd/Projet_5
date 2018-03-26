<?php if(isset($error_report)): ?>
	<div class="error"><?= $error_report; ?> <i class="fas fa-times"></i></div>
<?php elseif (isset($success_report)): ?>
	<div class="success"><?= $success_report; ?> <i class="fas fa-times"></i></div>
<?php endif; ?>