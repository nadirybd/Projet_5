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
		
		$subcat = function($attributes, $category_id){
			$subcategories = $this->categoriesModel->selectSubCategories($attributes, 'category_id');
				$sub = "";
			foreach ($subcategories as $subcategory) {
				$sub .= '| <a href="'. $subcategory->id .'">'; 
				$sub .= $subcategory->name .'</a> '; 
			}
			$sub = substr($sub, 2, strlen($sub));
			return $sub;
		};

		$this->render('forum', compact('categories', 'subcat'));
	}

	/**
	* Méthode forum qui gère l'affichage de la page forum
	*/
	public function menu(){
		$categories = $this->categoriesModel->select();
		
		$subcat = function($attributes, $category_id){
			$subcategories = $this->categoriesModel->selectSubCategories($attributes, 'category_id');
				$sub = "";
			foreach ($subcategories as $subcategory) {
				$sub .= '| <a href="'. $subcategory->id .'">'; 
				$sub .= $subcategory->name .'</a> '; 
			}
			$sub = substr($sub, 2, strlen($sub));
			return $sub;
		};

		$this->render('forum', compact('categories', 'subcat'));
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