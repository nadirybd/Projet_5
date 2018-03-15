<?php
require('app/App.php');
App::load();

use App\Controller\Frontend\FrontController;

if(isset($_GET['p']) && !empty($_GET['p'])){
	$page = $_GET['p'];
} else {
	$page = 'home';
}

if($page === 'home'){
	FrontController::getInstance()->homepage();
}
