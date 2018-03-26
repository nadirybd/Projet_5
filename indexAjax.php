<?php
require('app/App.php');
App::loadAjax();

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

	default:
		break;
}
