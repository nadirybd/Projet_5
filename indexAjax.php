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
		
	case 'report':
		AjaxController::getInstance()->ajaxReportComment();
		break;

	case 'chat':
		AjaxController::getInstance()->ajaxChat();
		break;

	case 'cookies':
		AjaxController::getInstance()->ajaxCookies();
		break;

	case 'events':
		AjaxController::getInstance()->ajaxEvents();
		break;

	default:
		break;
}
