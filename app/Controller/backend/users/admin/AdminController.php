<?php
namespace App\Controller\Backend\Users\Admin;
use Core\Controller\Controller;
/**
* Classe AdminController qui va gèrer la logique entre "models" et 
* "view" 
*/
class AdminController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend/users/admin';
	private static $_instance;

	/**
	*
	*/
	public function admin(){
		if($this->logged() && isset($_SESSION['admin'])){
			$lastTopics = $this->topicsModel->lastTopics(5);
			$reportedMessages = $this->messagesModel->selectByReport();
			$userMessages = function($user_id){
				$user = $this->usersModel->select([$user_id], 'id');
				return $user;
			};

			$this->render('admin', compact('lastTopics', 'reportedMessages', 'userMessages'));
		} else {
			header('location: forbidden');
		}
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new AdminController();
		}
		return self::$_instance;
	}
}