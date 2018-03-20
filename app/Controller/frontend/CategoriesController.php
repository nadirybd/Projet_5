<?php
namespace App\Controller\Frontend;
use Core\Controller\Controller;
/**
* CategoriesController classe qui gère l'affichage des catégories en 
* faisant le lien entre "model" et "view"
*/
class CategoriesController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'frontend';
	private static $_instance;

	/**
	* Méthode forum qui gère l'affichage de la page forum
	*/
	public function forum(){
		$this->render('forum');
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new CategoriesController();
		}
		return self::$_instance;
	}	
}