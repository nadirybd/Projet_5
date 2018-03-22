<?php
require('app/App.php');
App::load();

use App\Controller\Ajax\AjaxController;

if(isset($_GET['req']) && !empty($_GET['req'])){
	$request = $_GET['req'];
}

switch ($request) {
	case 'subcategories':
		AjaxController::getInstance()->ajaxFormTopic();
		break;

	default:
		break;
}
