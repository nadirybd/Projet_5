<?php
namespace Core\Controller;
use App\Controller\Frontend\CategoriesController;
/**
* Classe Parent des différents controllers
*/
class Controller
{
	/**
	* @var $viewPath retourne le nom d'un dossier
	* @var $templates retourne le nom d'un fichier du dossier templates
	*/
	protected $viewPath;
	protected $templates = 'default';

	/**
	* @var stocke l'instance de la classe TopicsModel
	* @var stocke l'instance de la classe UsersModel
	*/
	protected $topicsModel;
	protected $usersModel;
	protected $categoriesModel;

	/**
	* Méthode __construct
	*/
	public function __construct(){
		if($this->topicsModel === null){
			$this->topicsModel = new \App\Model\TopicsModel();
		}
		if($this->usersModel === null){
			$this->usersModel = new \App\Model\UsersModel();
		}
		if($this->categoriesModel === null){
			$this->categoriesModel = new \App\Model\CategoriesModel();
		}
	}

	/**
	* Méthode render qui affiche la vue en reliant le fichier vue et le 
	* templates
	* @param 'string'
	* @param array()
	* @param null or not
	*/
	public function render($page, $array = null, $menuBis = null){
		ob_start();
		if(!is_null($array)){
			extract($array);
		}
		require('View/'. $this->viewPath .'/'. $page .'.php');
		
		$content = ob_get_clean();

		if(!is_null($menuBis)){
			ob_start();
			CategoriesController::getInstance()->menu();
			$menuBis = ob_get_clean();
		}

		require('View/templates/'. $this->templates .'.php');
	}

	/**
	* Méthode render qui affiche la vue en reliant le fichier vue et le 
	* templates
	* @param 'string'
	* @param array()
	* @param null or not
	*/
	public function ajaxRender($page, $array = null){
		ob_start();
		if(!is_null($array)){
			extract($array);
		}
		require('View//ajax/'. $page .'.php');
		$ajaxContent = ob_get_clean();
		require('View/ajax/ajax.php');
	}

	/**
	* Transfert de variable vers un template
	* @param 'string'
	* @param array()
	*/
	protected function templates($page, $array = null){
		if($array){
			extract($array);
		}
		require('View/templates/'. $page . '.php');
	}

	/**
	* @return bool
	*/
	public function logged(){
		if(isset($_SESSION['user']) && isset($_SESSION['user']['id'])){
			return true;
		}
	}

	/**
	* Méthode UrlCustom retourne l'url sans caractère spéciaux
	*/
	protected function urlCustom($url){
		return \App::encodedUrlCustom($url);
	}
}