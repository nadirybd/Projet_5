<?php
namespace App\Controller\Backend\Users;
use Core\Controller\Controller;
/**
* Classe UsersController qui va gèrer la logique entre "models" et 
* "view" 
*/
class UsersController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend/users';
	private static $_instance;

	/**
	* Méthode profile qui gère l'affichage de la page d'inscription
	* Et vérifie les données envoyées par l'utilisateur
	*/
	public function profile(){
		if($this->logged()){
			$infoUser = $this->usersModel->selectInfo([$_SESSION['user']['id']]);
			$this->render('profile', compact('infoUser'));
		} else {
			header('location: index.php?p=login');
		}
	}

	/**
	* Méthode qui gère la déconnexion 
	*/
	public function logout(){
		if($this->logged()){
			session_destroy();
			$this->render('logout');
			header('location: index.php');
		} else {
			header('location: index.php?p=login');
		}
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new UsersController();
		}
		return self::$_instance;
	}
}