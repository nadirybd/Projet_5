<?php
namespace App\Controller\Backend\Users\Admin;
use Core\Controller\Controller;
/**
* Classe TopicsController qui va gèrer la logique entre "models" et 
* "view" 
*/
class TopicsController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend/users/admin';
	private static $_instance;

	/**
	* Méthode delete qui gère la suppression d'un topic par l'admin
	*/
	public function delete(){
		if($this->logged() && isset($_SESSION['admin'])){

			if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){

				if(isset($_POST['admin-sub-delete'], $_POST['admin_confirm_delete'])){
					$confirm_delete = $_POST['admin_confirm_delete'];
					if(!empty($confirm_delete) && $confirm_delete === 'SUPPRIMER'){
							$topic_delete = $this->topicsModel->delete([$_GET['id']]);
							$message_delete = $this->messagesModel->deleteByTopic([$_GET['id']]);
							$categories_delete = $this->categoriesModel->deleteByTopic([$_GET['id']]);
							$follow_delete = $this->followModel->deleteByTopic([$_GET['id']]);
							header('location: /Forum/admin');
					} else {
						$error_delete = 'Veuillez confirmez la suppression en entrant le mot : SUPPRIMER';
					}
				}

				$this->render('delete-topic', compact('lastTopics'));
			} else {
				header('location: /Forum/admin');
			}
		} else {
			header('location: forbidden');
		}
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new TopicsController();
		}
		return self::$_instance;
	}
}