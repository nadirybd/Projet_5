<?php
namespace App\Controller\Ajax;
use Core\Controller\Controller;
/**
* AjaxController classe qui gère l'affichage des requêtes Ajax
*/
class AjaxController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend';
	private static $_instance;

	/**
	* Méthode ajaxFormTopic gère les données envoyés et renvoi le résultat 
	*/
	public function ajaxFormTopic(){
		if(isset($_POST['id']) && intval($_POST['id']) && !empty($_POST['id']) && $_POST['id'] > 0){
			
			$subcategories = $this->categoriesModel->selectSubcategories([$_POST['id']], 'category_id');
			if(count($subcategories) > 0){
				$this->ajaxRender('subcategories', compact('subcategories'));
			}
		}
	}

	/**
	* Méthode ajaxReportComment gère les données envoyés et renvoi le résultat 
	*/
	public function ajaxReportComment(){
		if(isset($_POST['report_id']) && intval($_POST['report_id']) && !empty($_POST['report_id']) && $_POST['report_id'] > 0){

			$report = $this->messagesModel->updateReport([$_POST['report_id']]);

			if($report){
				$success_report = 'Le commentaire a été signalé !';
			} else {
				$error_report = 'Une erreur est survenue !';
			}
			
			$this->ajaxRender('report', compact('success_report', 'error_report'));
		}
	}

	/**
	* Méthode ajaxChat gère les données envoyés et renvoi le résultat 
	*/
	public function ajaxChat(){
		if(isset($_POST['action']) && !empty($_POST['action'])){
			if($this->logged()){
				if($_POST['action'] == 'addMessage'){
					if(isset($_POST['text_chat'])){
						$chat_text = $_POST['text_chat'];
						if(!empty($chat_text)){
							if(strlen($chat_text) <= 255){
								$addText = $this->chatModel->add([
									$_SESSION['user']['id'],
									$chat_text
								]);
							} 
						}
					}
				}
			}

			if($_POST['action'] == 'getMessages'){
				$allChat = $this->chatModel->select();
				$allChat = array_reverse($allChat);
			 	$user = function($user_id){
			 		$user = $this->usersModel->select([$user_id], 'id');
			 		return $user;
			 	};

				$this->ajaxRender('chatAjax', compact('allChat', 'user'));
			}
		}
	}

	/**
	* Méthode ajaxCookies gère l'acceptation des cookies
	*/
	public function ajaxCookies(){
		if(isset($_POST['accept']) && !empty($_POST['accept'])){
			if($_POST['accept'] == true){
				$accept = setcookie('accept_cookies', true, time()+60*60*24*60, '/', null, false, true);
			}
		}
	}

	/**
	* Méthode ajaxEvents gère l'envoi des données des événements
	*/
	public function ajaxEvents(){
		$events = $this->eventsModel->select();
		echo json_encode($events);
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new AjaxController();
		}
		return self::$_instance;
	}	
}