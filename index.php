<?php
require('app/App.php');
App::load();

use App\Controller\Frontend\FrontController;
use App\Controller\Frontend\Users\UsersController;
use App\Controller\Backend\Users\UsersController as BackUsersController;

if(isset($_GET['p']) && !empty($_GET['p'])){
	$page = $_GET['p'];
} else {
	$page = 'home';
}

switch ($page) {
	case 'home':
		FrontController::getInstance()->homepage();
		break;
	
	case 'subscribe':
		UsersController::getInstance()->subscribe();
		break;
	
	case 'login':
		UsersController::getInstance()->login();
		break;
	
	case 'profile':
		BackUsersController::getInstance()->profile();
		break;

	case 'logout':
		BackUsersController::getInstance()->logout();
		break;

	case 'edit_profile':
		BackUsersController::getInstance()->editProfile();
		break;

	case 'edit_avatar':
		BackUsersController::getInstance()->editAvatar();
		break;

	default:
		$page = '404';
		break;
}
