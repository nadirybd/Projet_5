<?php
namespace App\Controller\Ajax;
use Core\Controller\Controller;
/**
* AjaxController classe qui gère l'affichage des requêtes Ajax
*/
class AjaxController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend';
	private static $_instance;

	/**
	*
	*/
	public function ajaxFormTopic(){
		if(isset($_POST['id']) && intval($_POST['id']) && !empty($_POST['id']) && $_POST['id'] > 0){
			
			$subcategories = $this->categoriesModel->selectSubcategories([$_POST['id']], 'category_id');
			if(count($subcategories) > 0){
				$this->ajaxRender('subcategories', compact('subcategories'));
			}
		}
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new AjaxController();
		}
		return self::$_instance;
	}	
}