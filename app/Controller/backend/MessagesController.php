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
		$this->render('edit-message');
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