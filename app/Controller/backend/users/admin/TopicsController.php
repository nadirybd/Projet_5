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
			$topic = $this->topicsModel->select();
			$this->render('admin-delete-topic', compact('lastTopics'));
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