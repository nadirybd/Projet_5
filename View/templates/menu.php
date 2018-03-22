<nav id="menuBis">
	<?php foreach($categories as $category): ;?>
		<ul>
			<li><a href="<?= $url($category->name, $category->id); ?>"><?= $category->name; ?></a>
				<ul class="submenu">
				<?= $subcat($category->id, $category->id, $category->name); ?>
				</ul>
			</li>
		</ul>
	<?php endforeach; ?>
</nav>