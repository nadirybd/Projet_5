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
		$categories = $this->categoriesModel->select();
		$lastTopics = $this->topicsModel->lastTopics(10);
		$allChat = $this->chatModel->select();
		$allChat = array_reverse($allChat);
		$user = function($user_id){
		 	$user = $this->usersModel->select([$user_id], 'id');
		 	return $user;
		 };

		$nbTopics = function($attributes){
			$number_of_topics = $this->topicsModel->count([$attributes], 'category_id');
			
			return $number_of_topics;
		};

		$subcat = function($attributes, $category_id, $category_name){
			$subcategories = $this->categoriesModel->selectSubCategories([$attributes], 'category_id');
				$sub = "";
			foreach ($subcategories as $subcategory) {
				$subUrl ='topics/'. $this->urlCustom($category_name).'/';
				$subUrl .= $this->urlCustom($subcategory->name).'/'.$subcategory->id;

				$sub .= '| <a href="'. $subUrl .'-1">'; 
				$sub .= $subcategory->name .'</a> '; 
			}
			$sub = substr($sub, 2, strlen($sub));
			return $sub;
		};
		
		$url = function($url1, $url2){
			$urlCustom = 'topics/'.$this->urlCustom($url1).'/'.$this->urlCustom($url2);
			return $urlCustom;
		};

		$this->render('forum', compact('categories', 'subcat', 'lastTopics', 'nbTopics', 'url', 'allChat', 'user'), true);
	}

	/**
	* Méthode forum qui gère l'affichage de la page forum
	*/
	public function menu(){
		$categories = $this->categoriesModel->select();
		
		$subcat = function($attributes, $category_id, $category_name){
			$subcategories = $this->categoriesModel->selectSubCategories([$attributes], 'category_id');
				$sub = "";
			foreach ($subcategories as $subcategory) {
				$subUrl ='topics/'. $this->urlCustom($category_name).'/';
				$subUrl .= $this->urlCustom($subcategory->name).'/'.$subcategory->id;

				$sub .= '
				<li>
					<a href="'. $subUrl .'-1">'. $subcategory->name .'</a>
				</li>'; 
			}
			return $sub;
		};

		$url = function($url1, $url2){
			$urlCustom = 'topics/'.$this->urlCustom($url1).'/'.$this->urlCustom($url2);
			return $urlCustom;
		};
		$this->templates('menu', compact('categories', 'subcat', 'url'));
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