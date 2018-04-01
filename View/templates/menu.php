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
	<p><span class="burger-menuBis"><i class="fas fa-ellipsis-v fa-2x"></i></span></p>
</nav>

<div id="menuBis-mobile">
<?php foreach($categories as $category): ;?>
		<div class="menu-mobile">
			<div class="menu-mobile-container">
				<div class="menu-cat">
					<h3><a href=""><?= $category->name; ?></a></h3>
					<i class="fas fa-chevron-down"></i>
				</div>
				<div class="subcat hide-subcat">
					<ul class="subcat-list">
						<?= $subcat($category->id, $category->id, $category->name); ?>
					</ul>
				</div>
				<hr/> 
			</div>
		</div>
<?php endforeach; ?>
</div>

<script src="public/js/menubis.js"></script>