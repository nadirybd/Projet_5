<nav id="menuBis">
<?php foreach($categories as $category): ;?>
		<ul>
			<li>
				<a href="<?= $url($category->name, $category->id); ?>-1"><?= $category->name; ?></a>
				<ul class="submenu">
					<?= $subcat($category->id, $category->id, $category->name); ?>
				</ul>
			</li>
		</ul>
<?php endforeach; ?>
	<div id="create-topic">
		 <a href="add-topic"><i class="fas fa-plus-circle"></i> Ajouter un topic</a>
	</div>
</nav>