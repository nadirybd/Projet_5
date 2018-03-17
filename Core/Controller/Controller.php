<?php
namespace Core\Controller;
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
	}

	/**
	* Méthode render qui affiche la vue en reliant le fichier vue et le 
	* templates
	*/
	public function render($page, $array = null){
		ob_start();
		if(!is_null($array)){
			extract($array);
		}
		require('View/'. $this->viewPath .'/'. $page .'.php');
		$content = ob_get_clean();
		require('View/templates/'. $this->templates .'.php');
	}

	/**
	* @return bool
	*/
	public function logged(){
		if(isset($_SESSION['user'])){
			return true;
		}
	}
}