<?php
namespace App\Controller\Backend;
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
	protected $viewPath = 'backend';
	private static $_instance;

	/**
	* Gère l'affichage du commentaire à modifier et vérifie les données entrées par l'utilisateur 
	*/
	public function editMessage(){
		if($this->logged()){
			if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
				$verifyId = $this->messagesModel->count([$_GET['id'], $_SESSION['user']['id']], 'id', 'user_id');
				if($verifyId == 1){
					$message = $this->messagesModel->selectOne([$_GET['id']], 'id');
					if(isset($_POST['sub-editMessage'], $_POST['edit_message']) && $_POST['edit_message'] !== $message->content){
						$editMessage = $_POST['edit_message'];
						if(!empty($editMessage)){
							$this->messagesModel->update([$editMessage, $_GET['id']]);
							header('location: topic/webmastertopic-'. $message->topic_id .'-1');
						} else {
							$error_edit = 'Le champs ne peut pas être vide !';
						}
					}
				} else {
					header('location: forbidden');
				}
			} else {
				header('location: forbidden');
			}
			$this->render('edit-message', compact('message', 'error_edit'));
		} else {
			header('location: forbidden');
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