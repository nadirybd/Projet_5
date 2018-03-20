<?php
require('app/App.php');
App::load();

use App\Controller\Frontend\FrontController;
use App\Controller\Frontend\Users\UsersController;
use App\Controller\Frontend\CategoriesController;

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

	case '404':
		FrontController::getInstance()->notFound();
		break;
	
	case 'subscribe':
		UsersController::getInstance()->subscribe();
		break;
	
	case 'login':
		UsersController::getInstance()->login();
		break;

	case 'recuperation_mail':
		UsersController::getInstance()->recuperation();
		break;

	case 'recuperation_code':
		UsersController::getInstance()->nextRecuperation();
		break;

	case 'reset_password':
		UsersController::getInstance()->resetPassword();
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

	case 'forum':
		CategoriesController::getInstance()->forum();
		break;

	default:
		$page = '404';
		break;
}
