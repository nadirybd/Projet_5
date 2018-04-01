<?php
namespace App\Controller\Frontend;
use Core\Controller\Controller;
/**
* Classe PostsController qui va gèrer la logique entre "models" et 
* "view" 
*/
class PostsController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'frontend';
	private static $_instance;

	/**
	*
	*/
	public function blog(){
		$allPosts = $this->postsModel->select();
		$number_of_posts = count($allPosts);
		$posts_per_page = 8;
		$number_of_pages = ceil($number_of_posts / $posts_per_page);
		$href = 'blog-';
		$pagination = $this->getPagination()->getPage($number_of_pages, $href);
		$from = $this->getPagination()->verifyPage($_GET['page'], $number_of_pages, $posts_per_page);
		$posts = $this->postsModel->selectByLimit($from, $posts_per_page);
		$this->render('blog', compact('posts', 'pagination'), true);
	}

	/**
	*
	*/
	public function post(){
		if(isset($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
			$post = $this->postsModel->select([$_GET['id']], 'id');
			if(empty($post)){
				header('location: /Forum/blog');
			}
		} else {
			header('location: /Forum/blog');
		}

		$this->render('show-post', compact('post'), true);
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new PostsController();
		}
		return self::$_instance;
	}
}