<nav id="menuBis">
	<?php foreach($categories as $category): ;?>
		<ul>
			<li><a href="<?= $url($category->name, $category->id); ?>"><?= $category->name; ?></a>
				<?php $subcategories = $subcat([$category->id]); ?>
				<ul class="submenu">
				<?php foreach($subcategories as $sub): ?>
					<li><a href="#"><i class="fas fa-code"></i> | <?= $sub->name; ?></a></li>
				<?php endforeach; ?>
				</ul>
			</li>
		</ul>
	<?php endforeach; ?>
</nav>