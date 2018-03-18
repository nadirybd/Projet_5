<?php
namespace App\Controller\Backend\Users;
use Core\Controller\Controller;
/**
* Classe UsersController qui va gèrer la logique entre "models" et 
* "view" 
*/
class UsersController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend/users
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'backend/users';
	private static $_instance;

	/**
	* Méthode profile qui gère l'affichage de la page de profile backend
	* Et vérifie les données envoyées par l'utilisateur
	*/
	public function profile(){
		if($this->logged()){
			$infoUser = $this->usersModel->selectInfo([$_SESSION['user']['id']]);
			$user =	$this->usersModel->select([$_SESSION['user']['id']], 'id');
			$this->render('profile', compact('infoUser', 'user'));
		} else {
			header('location: index.php?p=login');
		}
	}

	/**
	* Méthode editProfile qui gère l'affichage de la page de modification
	* du profile et vérifie les données envoyées par l'utilisateur
	*/
	public function editProfile(){
		if($this->logged()){
			if(isset($_SESSION['user']['id'])){
				$user =	$this->usersModel->select([$_SESSION['user']['id']], 'id');
	
				if(!empty($_POST['edit_name']) && isset($_POST['edit_name']) && $_POST['edit_name'] !== $user->pseudo){
					$edit_name = htmlspecialchars($_POST['edit_name']);
					if(strlen($username) < 70){
						$nameVerify = $this->usersModel->count([$edit_name], 'pseudo');
						if($nameVerify == 0){
							$this->usersModel->update([
								':pseudo' => $edit_name,
								':id' => $_SESSION['user']['id']
							], 'pseudo');

							$_SESSION['user']['name'] = $edit_name;
							header('location: index.php?p=profile');
						} else {
							$edit_error = 'Le nom d\'utilisateur existe déjà !';
						}
					} else {
						$edit_error = 'Veuillez ne pas dépasser la limite de 70 caractères pour le nom d\'utilisateur !';
					}
				}

				if(!empty($_POST['edit_mail']) && isset($_POST['edit_mail']) && $_POST['edit_mail'] !== $user->mail){
					$edit_mail = htmlspecialchars($_POST['edit_mail']);
					
					if(filter_var($edit_mail, FILTER_VALIDATE_EMAIL)){
						
						$mailVerify = $this->usersModel->count([$edit_mail], 'mail');
						if($mailVerify == 0){
							
							$this->usersModel->update([
								':mail' => $edit_mail,
								':id' => $_SESSION['user']['id']
							], 'mail');

							$_SESSION['user']['mail'] = $edit_mail;
							header('location: index.php?p=profile');
						} else {
							$edit_error = 'L\'adresse mail existe déjà !';
						}
					} else {
						$edit_error = 'Format de l\'adresse mail invalide !';
					}
				}

				if(!empty($_POST['edit_pass']) && isset($_POST['edit_pass']) && !empty($_POST['confirm_edit_pass']) && isset($_POST['confirm_edit_pass']) && isset($_POST['old_pass']) && !empty($_POST['old_pass'])){

					$edit_pass = password_hash($_POST['edit_pass'], PASSWORD_BCRYPT);
					$edit_confirm_pass = $_POST['confirm_edit_pass'];

					if(password_verify($_POST['old_pass'], $user->password)){
						if(password_verify($edit_confirm_pass, $edit_pass)){
							$this->usersModel->update([
								':password' => $edit_pass,
								':id' => $_SESSION['user']['id']
							], 'password');

							$success = 'Le mot de passe a bien été changé !';
						} else {
							$edit_error = 'Vos mots de passes ne correspondent pas !';
						}
					} else {
						$edit_error = 'Votre ancien mot de passe est invalide !';
					}
				} 
			}

			$this->render('edit_profile', compact('edit_error', 'success'));
		} else {
			header('location: index.php?p=login');
		}
	}

	/**
	* Méthode qui gère la déconnexion 
	*/
	public function logout(){
		if($this->logged()){
			$_SESSION = array();
			session_destroy();
			$this->render('logout');
			header('location: index.php');
		} else {
			header('location: index.php?p=login');
		}
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new UsersController();
		}
		return self::$_instance;
	}
}