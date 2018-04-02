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
			$lastTopics = $this->topicsModel->lastTopics(10);
			$lastUsers = $this->usersModel->selectNewUsers(10);
			$reportedMessages = $this->messagesModel->selectByReport();
			$userMessages = function($user_id){
				$user = $this->usersModel->select([$user_id], 'id');
				return $user;
			};
			if(isset($_POST['sub-pull-report'], $_POST['pull_report'])){
				$pull_report = $_POST['pull_report'];
				if(!empty($pull_report) && intval($pull_report)){
					$this->messagesModel->updateReport([$pull_report], true);
					$this->redirection('admin');
				} 
			}
			if(isset($_POST['sub-delete-user'], $_POST['delete_user'])){
				$delete_user = $_POST['delete_user'];
				if(!empty($delete_user)){
					$this->usersModel->delete([$delete_user], 'pseudo', 'members');
					$success_delete_user = 'L\'utilisateur '.$delete_user.' a bien été supprimé';
				} 
			}
			$this->render('admin', compact('lastTopics', 'reportedMessages', 'userMessages', 'lastUsers', 'success_delete_user'), true);
		} else {
			$this->redirection('forbidden');
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