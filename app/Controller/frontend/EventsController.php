<?php
namespace App\Controller\Frontend;
use Core\Controller\Controller;
/**
* Classe EventsController qui va gèrer la logique entre "models" et 
* "view" 
*/
class EventsController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'frontend';
	private static $_instance;

	/**
	* Méthode events va gérer la vue events
	*/
	public function events(){
		$this->render('event/events', null, true);
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new EventsController();
		}
		return self::$_instance;
	}
}