<?php
namespace App\Controller\Ajax;
use Core\Controller\Controller;
/**
* AjaxController classe qui gère l'affichage des requêtes Ajax
*/
class AjaxController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend';
	private static $_instance;

	/**
	* Méthode ajaxFormTopic gère les données envoyés et renvoi le résultat 
	*/
	public function ajaxFormTopic(){
		if(isset($_POST['id']) && intval($_POST['id']) && !empty($_POST['id']) && $_POST['id'] > 0){
			
			$subcategories = $this->categoriesModel->selectSubcategories([$_POST['id']], 'category_id');
			if(count($subcategories) > 0){
				$this->ajaxRender('subcategories', compact('subcategories'));
			}
		}
	}

	/**
	* Méthode ajaxReportComment gère les données envoyés et renvoi le résultat 
	*/
	public function ajaxReportComment(){
		if(isset($_POST['report_id']) && intval($_POST['report_id']) && !empty($_POST['report_id']) && $_POST['report_id'] > 0){

			$report = $this->messagesModel->updateReport([$_POST['report_id']]);

			if($report){
				$success_report = 'Le commentaire a été signalé !';
			} else {
				$error_report = 'Une erreur est survenue !';
			}
			
			$this->ajaxRender('report', compact('success_report', 'error_report'));
		}
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new AjaxController();
		}
		return self::$_instance;
	}	
}