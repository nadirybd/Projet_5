<?php
namespace App\Controller\Backend\Users\Admin;
use Core\Controller\Controller;
/**
* Classe PostsController qui va gèrer la logique entre "models" et 
* "view" 
*/
class PostsController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users/admin
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend/users/admin';
	private static $_instance;

	/**
	*
	*/
	public function addPost(){
		if($this->logged() && $_SESSION['admin']){
			if(isset($_POST['sub-add-post'], $_POST['add_post_title'], $_POST['add_post_content'], $_FILES['addPost_img'])){

				$addTitle = $_POST['add_post_title'];
				$addContent = $_POST['add_post_content'];
				$addImg = $_FILES['addPost_img'];
				$addImgName = $addImg['name'];
				$addImgSize = $addImg['size'];
				$addImgTmp = $addImg['tmp_name'];
				$addImgError = $addImg['error'];

				if(!empty($addTitle) && !empty($addContent) && !empty($addImgSize)){
					if(strlen($addTitle) <= 150){
						$ext = strtolower(substr($addImgName, -3));
						$authorized = ['jpg', 'png', 'gif'];
						if($addImgError < 1){				
							if(in_array($ext, $authorized)){
								$maxsize = 2097152;
								if($addImgSize <= $maxsize){
									$newImgName = uniqid('', true).'.'.$ext;
									$new_path = 'public/images/posts/'.$newImgName;
									$move_img = move_uploaded_file($addImgTmp, $new_path);

									if($move_img){
										$this->postsModel->add([
											':post_title' => $addTitle,
											':post_content' => $addContent,
											':post_img' => $newImgName
										]);

										\App\Thumbs::getInstance()->getThumb($ext, $new_path, $newImgName);
										
										header('location: /Forum/blog');
									} else {
										$post_error = 'Une erreur est survenue lors du transfert de l\'image';
									}
								} else {
									$post_error = 'La taille ne doit pas dépasser la limite de 2Mo';
								}
							} else {
								$post_error = 'Extension invalide ! Les extensions valides sont : jpg, png ou gif';
							}
						} else {
							$post_error = 'Une erreur est survenue lors de l\'upload de l\'image';
						}
					} else {
						$post_error = 'La limite de 150 caractères pour le titre a été dépassé';
					}
				}
			} 
			$this->render('add-post', compact('post_error'));
		} else {
			header('location: forbidden');
		}
	}

	/**
	* Méthode listPosts qui gère la page de list-posts d'un post
	*/
	public function listPosts(){
		if(isset($_SESSION['admin']) && $this->logged()){
			$allPosts = $this->postsModel->select();
			$number_of_posts = count($allPosts);
			$posts_per_page = 5;
			$number_of_pages = ceil($number_of_posts / $posts_per_page);

			if(isset($_GET['page']) && intval($_GET['page']) && $_GET['page'] > 0){
				$from = $posts_per_page * ($_GET['page'] - 1);
			} else {
				$_GET['page'] = 1;
				$from = $posts_per_page * ($_GET['page'] - 1);
			}
			$pagination = $this->pagination($number_of_pages, 'admin/list-posts-');
			$posts = $this->postsModel->selectByLimit($from, $posts_per_page);
			
			$this->render('list-posts', compact('posts', 'pagination'));
		} else {
			header('location: forbidden');
		}
	}
	
	/**
	* Méthode delete qui gère la page de suppression d'un post
	*/
	public function delete(){
		if(isset($_SESSION['admin']) && $this->logged()){
			if(isset($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
				if(isset($_POST['sub-delete-post'], $_POST['confirm_delete_post'])){
					$confirmDelete = $_POST['confirm_delete_post'];
					if(!empty($confirmDelete) && $confirmDelete === 'SUPPRIMER'){
						$post = $this->postsModel->select([$_GET['id']], 'id');
						
						$destroyimg = unlink('public/images/posts/'.$post->post_img);
						$destroythumb = unlink('public/images/posts/thumbs/thumb_'.$post->post_img);
						
						$delete = $this->postsModel->delete([$_GET['id']]);
						if($delete){
							header('location: /Forum/admin');
						} else {
							$error_delete = 'Une erreur est survenue veuillez réessayer !';
						}
					} else {
						$error_delete = 'Veuillez écrire le mot : SUPPRIMER';
					}
				}
				$this->render('delete-post', compact('error_delete'));
			} else {
				header('location: /Forum/admin');
			}
		} else {
			header('location: forbidden');
		}
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