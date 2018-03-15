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
	*/
	protected $viewPath = 'frontend';
	private static $_instance;

	/**
	* Méthode home qui gère l'affichage de la homepage
	*/
	public function homepage(){
		$this->render('home');
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