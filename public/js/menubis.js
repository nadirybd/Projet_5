$(document).ready(function(){
	var menuBis_mobile = $('#menuBis-mobile');
	var activeMenuBis = 'menuBis-mobile-active';
	var button = '.burger-menuBis';
	var btn_menuCat = $('.menu-cat .fa-chevron-down');
	var menuCat = $('.menu-cat');
	var submenuHide = 'hide-subcat';

 	toggleSideBar(button, '#menuBis-mobile', activeMenuBis);
 	toggleSubmenuBar(btn_menuCat, '.subcat', submenuHide, menuCat);

});

function toggleSideBar(button, sideBar, className){
	$(button).click(function(){
		$(sideBar).toggleClass(className, 500);
	});
}

function toggleSubmenuBar(button, sideBar, className, parent){
	$(button).click(function(){
		$(this).parent(parent).next(sideBar).toggleClass(className, 500);
	});
}
