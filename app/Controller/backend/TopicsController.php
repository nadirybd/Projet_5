<?php
namespace App\Controller\Backend;
use Core\Controller\Controller;
/**
* TopicsController classe qui gère l'affichage des topics en 
* faisant le lien entre "model" et "view"
*/
class TopicsController extends Controller
{	
	/**
	* @var $viewPath retourne le nom du dossier backend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend';
	private static $_instance;

	/**
	* Méthode addTopic qui va gèrer les données entrer par l'utilisateur 
	* en les vérifiant puis enverra les données au model
	*/
	public function addTopic(){
		if($this->logged()){
			$categories = $this->categoriesModel->select();

			if(isset($_POST['submit-addtopic'], $_POST['addtopic_cat'], $_POST['addtopic_title'], $_POST['addtopic_subcat'],  $_POST['addtopic_subcat'])){

				$addtitle = htmlspecialchars($_POST['addtopic_title']);
				$addCategory = htmlspecialchars($_POST['addtopic_cat']);
				$addSubcategory = htmlspecialchars($_POST['addtopic_subcat']);
				$addContent = htmlspecialchars($_POST['addtopic_content']);

				if(!empty($addtitle) && !empty($addCategory) && !empty($addSubcategory) && !empty($addContent)){
					$subCat = $this->categoriesModel->selectSubCategories([$addSubcategory, $addCategory], 'id', 'category_id');
					$verifySubcat = count($subCat);
					if($verifySubcat > 0){
						if(strlen($addtitle) <= 100){
							if(isset($_POST['notif_on'])){
								$topic = $this->topicsModel->add([
									':user_id' => $_SESSION['user']['id'],
									':title' => $addtitle,
									':content' => $addContent,
									':user_notif' => 1,
								]);
							} else {
								$topic = $this->topicsModel->add([
									':user_id' => $_SESSION['user']['id'],
									':title' => $addtitle,
									':content' => $addContent,
									':user_notif' => 0,
								]);
							}
							if($topic > 0){
								$this->categoriesModel->insertTopicId([
									':topic_id' => $topic,
									':category_id' => $addCategory,
									':subcategory_id' => $addSubcategory
								]);
								$this->redirection('topic/webmastertopic-'.$topic.'-1');
							}
						} else {
							$error_addtopic = "Le titre ne peut dépasser 100 caractères";
						}
					} else {
						$error_addtopic = "Veuillez sélectionner correctement les catégories";
					}
				} else {
					$error_addtopic = "Veuillez remplir tous les champs";
				}
			}

			$this->render('add-topic', compact('categories', 'error_addtopic'));
		} else {
			$this->redirection('login');
		}
	}

	/**
	* Méthode editTopic qui gère l'édition d'un topic en faisant le lien entre "model" et "view" mais aussi en vérifiant les données entrées par l'utilisateur
	*/
	public function editTopic(){
		if($this->logged()){
			if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
				$topic_id = $_GET['id'];
				$verify_user_topic = $this->topicsModel->count([$topic_id, $_SESSION['user']['id']], 'id', 'user_id', 'f_topics');
				if($verify_user_topic == 1){
					$topic = $this->topicsModel->select([$topic_id], 'id');
					if(isset($_POST['sub-edit-topic'])){
						if(isset($_POST['edit_title']) && !empty($_POST['edit_title']) && $_POST['edit_title'] !== $topic->title){
							$this->topicsModel->update([
								':title' => $_POST['edit_title'],
								':id' => $topic->id
							], 'title');
							$this->redirection('profile');
						} else {
							$error_edit = 'Les champs sont vides ou bien identiques !';
						}

						if(isset($_POST['edit_content']) && !empty($_POST['edit_content']) && $_POST['edit_content'] !== $topic->content){
							$this->topicsModel->update([
								':content' => $_POST['edit_content'],
								':id' => $topic->id
							], 'content');
							$this->redirection('profile');
						} else {
							$error_edit = 'Les champs sont vides ou bien identiques !';
						}
					}
				} else {
					$this->redirection('forbidden');
				}

				$this->render('edit-topic', compact('topic', 'error_edit'));
			}
		} else {
			$this->redirection('forbidden');
		}
	}

	/**
	* Méthode deleteTopic qui va supprimer gérer la suppression en vérifiant les données de l'utilisateur
	*/
	public function deleteTopic(){
		if($this->logged()){
			if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
				$verify_user_topic = $this->topicsModel->countTopic([$_GET['id'], $_SESSION['user']['id']], 'id', 'user_id');
				if($verify_user_topic == 1){
					if(isset($_POST['sub-delete'], $_POST['confirm_delete'])){
						$confirm_delete = $_POST['confirm_delete'];
						if(!empty($confirm_delete) && $confirm_delete === 'SUPPRIMER'){
								$topic_delete = $this->topicsModel->delete([$_GET['id']]);
								$message_delete = $this->messagesModel->deleteByTopic([$_GET['id']]);
								$categories_delete = $this->categoriesModel->deleteByTopic([$_GET['id']]);
								$follow_delete = $this->followModel->deleteByTopic([$_GET['id']]);
								$this->redirection('profile');
						} else {
							$error_delete = 'Veuillez confirmez la suppression en entrant le mot : SUPPRIMER';
						}
					}
				} else {
					$this->redirection('forbidden');
				}
				$this->render('delete-topic');
			} else {
				$this->redirection('profile');
			}
		} else {
			$this->redirection('forbidden');
		}
	}

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