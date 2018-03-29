<?php
namespace App\Controller\Frontend;
use Core\Controller\Controller;
/**
* Classe FrontController qui va gèrer la logique entre "models" et 
* "view" 
*/
class FrontController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'frontend';
	private static $_instance;

	/**
	* Méthode home qui gère l'affichage de la homepage
	*/
	public function homepage(){
		$lastTopic = $this->topicsModel->lastTopics(1, true);
		$this->render('home', compact('lastTopic'), true);
	}

	/**
	* Méthode home qui gère l'affichage de la page 404
	*/
	public function notFound(){
		$this->viewPath = 'errors';
		$this->render('404');
	}

	/**
	* Méthode home qui gère l'affichage de la forbidden
	*/
	public function forbidden(){
		$this->viewPath = 'errors';
		$this->render('forbidden');
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new FrontController();
		}
		return self::$_instance;
	}
}