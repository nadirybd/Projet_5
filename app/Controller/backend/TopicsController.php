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
			header('location: /Forum/login');
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