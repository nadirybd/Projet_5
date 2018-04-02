<?php
namespace App\Controller\Backend\Users\Admin;
use Core\Controller\Controller;
/**
* Classe MessagesController qui gère les messages et leurs affichages
*/
class MessagesController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend/users/admin';
	private static $_instance;

	/**
	*
	*/
	public function delete(){
		if($this->logged() && $_SESSION['admin']){
			if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
				if(isset($_POST['sub-delete-message'], $_POST['admin_delete_message'])){
					$messageDelete = $_POST['admin_delete_message'];
					if(!empty($messageDelete) && $messageDelete === 'SUPPRIMER'){
						var_dump($messageDelete);
						$delete = $this->messagesModel->delete([$_GET['id']]);
						$this->redirection('admin');
					} else {
						$error_delete = 'Veuillez écrire le mot : SUPPRIMER';
					}
				}
			}
			$this->render('delete-message');
		} else {
			$this->redirection('forbidden');
		}
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new MessagesController();
		}
		return self::$_instance;
	}	
}