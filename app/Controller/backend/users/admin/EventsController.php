<?php
namespace App\Controller\Backend\Users\Admin;
use Core\Controller\Controller;
/**
* Classe EventsController qui va gèrer la logique entre "models" et 
* "view" 
*/
class EventsController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend/users/admin/event';
	private static $_instance;

	/**
	* Méthode addEvent gère la page d'ajout d'un événement
	*/
	public function addEvent(){
		if($this->logged() && $_SESSION['admin']){
			if(isset($_POST['sub-event'], $_POST['event_info'], $_POST['event_address'], $_POST['event_date'], $_POST['event_title'])) {
				
				$event_title = $_POST['event_title'];
				$event_info = $_POST['event_info'];
				$event_date = $_POST['event_date'];
				$event_address = $_POST['event_address'];

				if(!empty($event_title) && !empty($event_info) && !empty($event_date) && !empty($event_address)) {

					$regex = preg_match('#^([0-9]{4})([\-/\.])([0-9]{2})([\-/\.])([0-9]{2})$#', $event_date);

					if($regex == 1){
						if(strlen($event_title) <= 150){
							$this->eventsModel->add([
								'address' => $event_address,
								'title' => $event_title,
								'info' => $event_info,
								'event_date' => $event_date
							]);
							$this->redirection('admin');
						} else {
							$addEvent_error = 'Le titre ne peut dépasser 150 caractères';
						}
					} else {
						$addEvent_error = 'Vérifier le bon format de date';
					}
				} else {
					$addEvent_error = 'Veuillez remplir tous les champs';
				}
			}
			$this->render('add-event', compact('addEvent_error'), true);
		} else {
			$this->redirection('forbidden');
		}
	}

	/**
	*
	*/
	public function listEvents(){
		if($this->logged() && $_SESSION['admin']){
			$allEvents = $this->eventsModel->select();
			$number_of_events = count($allEvents);
			$events_per_page = 5;
			$number_of_pages = ceil($number_of_events / $events_per_page);

			$pagination = $this->getPagination()->getPage($number_of_pages, 'admin/list-events-');

			$from = $this->getPagination()->verifyPage($_GET['page'], $number_of_pages, $events_per_page);

			$events = $this->eventsModel->selectByLimit($from, $events_per_page);

			$this->render('list-events', compact('events', 'pagination'), true);
		} else {
			$this->redirection('forbidden');
		}
	}

	/**
	* 
	*/
	public function editEvent(){
		if($this->logged() && $_SESSION['admin']){
			if(isset($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
				$event = $this->eventsModel->selectById([$_GET['id']]);
				if($event){
					if(isset($_POST['sub-edit-event'])){
						if(isset($_POST['edit_event_title']) && $_POST['edit_event_title'] !== $event->title){
							$edit_title = $_POST['edit_event_title'];
							if(!empty($edit_title)){
								if(strlen($edit_title) <= 150){
									$this->eventsModel->update([$edit_title, $_GET['id']], 'title');
									$this->redirection('admin/list-events-1');
								} else {
									$edit_error = 'Le titre ne peut dépasser 150 caractères';
								}
							} else {
								$edit_error = 'Les champs ne peuvent pas être vide';
							}
						}

						if(isset($_POST['edit_event_date']) && $_POST['edit_event_date'] !== $event->event_date){
							$edit_date = $_POST['edit_event_date'];
							if(!empty($edit_date)){
								$regex = preg_match('#^([0-9]{4})([\-/\.])([0-9]{2})([\-/\.])([0-9]{2})$#', $edit_date);
								if($regex == 1){
									$this->eventsModel->update([$edit_date, $_GET['id']], 'event_date');
									$this->redirection('admin/list-events-1');
								} else {
									$edit_error = 'Vérifier le format de la date';
								}
							} else {
								$edit_error = 'Les champs ne peuvent pas être vide';
							}
						}

						if(isset($_POST['edit_event_address']) && $_POST['edit_event_address'] !== $event->address){
							$edit_address = $_POST['edit_event_address'];
							if(!empty($edit_address)){
								$this->eventsModel->update([$edit_address, $_GET['id']], 'address');
								$this->redirection('admin/list-events-1');
							} else {
								$edit_error = 'Les champs ne peuvent pas être vide';
							}
						}

						if(isset($_POST['edit_event_info']) && $_POST['edit_event_info'] !== $event->info){
							$edit_info = $_POST['edit_event_info'];
							if(!empty($edit_address)){
								$this->eventsModel->update([$edit_info, $_GET['id']], 'info');
								$this->redirection('admin/list-events-1');
							} else {
								$edit_error = 'Les champs ne peuvent pas être vide';
							}
						}
					}
				} else {
					$this->redirection('admin');	
				}
				$this->render('edit-event', compact('event', 'edit_error'));
			} else {
				$this->redirection('admin');
			}
		} else {
			$this->redirection('forbidden');
		}
	}

	/**
	* Méthode delete gère la suppression d'un événement
	*/
	public function delete(){
		if($this->logged() && $_SESSION['admin']){
			if(isset($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){
				$event = $this->eventsModel->selectById([$_GET['id']]);
				if($event){
					if(isset($_POST['sub-delete-event'], $_POST['confirm_delete_event'])){
						$deleteEvent = $_POST['confirm_delete_event'];
						if(!empty($deleteEvent) && $deleteEvent === 'SUPPRIMER'){
							$this->eventsModel->delete([$_GET['id']]);
							$this->redirection('admin/list-events-1');
						} else {
							$error_delete = 'Veuillez écrire le mot : SUPPRIMER';
						}
					}
				} else {
					$this->redirection('admin');
				}
				$this->render('delete-event', compact('error_delete'));
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
			self::$_instance = new EventsController();
		}
		return self::$_instance;
	}
}