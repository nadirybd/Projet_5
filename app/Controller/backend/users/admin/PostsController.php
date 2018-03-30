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
										header('location: blog');
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
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new PostsController();
		}
		return self::$_instance;
	}
}