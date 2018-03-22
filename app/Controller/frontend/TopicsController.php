<?php
namespace App\Controller\Frontend;
use Core\Controller\Controller;
/**
* TopicsController classe qui gère l'affichage des topics en 
* faisant le lien entre "model" et "view"
*/
class TopicsController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'frontend';
	private static $_instance;

	/**
	* Méthode topics gère l'affichage de tous les topics dans la vue 
	* topics
	*/
	public function topics(){
		$allTopics = $this->topicsModel->select();
		$number_of_topics = count($allTopics);
		$number_per_page = 5;
		$number_of_page = ceil($number_of_topics / $number_per_page);
		
		$pagination = '';
		for ($page=1; $page <= $number_of_page ; $page++){
			$pagination .='| <a href="topics/'.$page.'">'.$page.'</a> ';
		}

		if(intval($_GET['page']) && isset($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
			$from = $number_per_page * ($_GET['page'] - 1);  
		} else {
			$_GET['page'] = 1;
			$from = $number_per_page * ($_GET['page'] - 1); 
		}

		$topics = $this->topicsModel->select($from, $number_per_page);

		$pagination = substr($pagination, 2, strlen($pagination));

		$user = function($user_id){
			$username = $this->usersModel->select([$user_id], 'id');
			if($username){
				$username = $username->pseudo;
			} else {
				$username = "Anonyme";
			}
			return $username;
		};

		$this->render('topics', compact('topics', 'pagination', 'user'), true);
	}

	/**
	* Méthode topicsByCat qui gère l'affichage des topics par catégorie
	*/
	public function topicsByCat(){
		if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id'])){
			$topics = $this->topicsModel->selectByCategory([$_GET['id']], 'category_id');
			
			$user = function($user_id){
				$username = $this->usersModel->select([$user_id], 'id');
				if($username){
					$username = $username->pseudo;
				} else {
					$username = "Anonyme";
				}
				return $username;
			};

			$verifytopic = count($topics);
			if($verifytopic <= 0) {
				header('location: /Forum/webmaster-forum');
			}
		}

		$this->render('category-topics', compact('topics', 'user'), true);
	}

	/**
	* Méthode topicsBySubcat qui gère l'affichage des topics par 
	* sous-catégorie
	*/
	public function topicsBySubcat(){
		if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id'])){
			$topics = $this->topicsModel->selectByCategory([$_GET['id']], 'subcategory_id');
			$verifytopic = count($topics);
			if($verifytopic <= 0) {
				header('location: /Forum/webmaster-forum');
			}

			$user = function($user_id){
				$username = $this->usersModel->select([$user_id], 'id');
				if($username){
					$username = $username->pseudo;
				} else {
					$username = "Anonyme";
				}
				return $username;
			};
		}

		$this->render('category-topics', compact('topics', 'user'), true);
	}

	/**
	* 
	*/
	

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new TopicsController();
		}
		return self::$_instance;
	}	
}