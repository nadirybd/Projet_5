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
			$topics = $this->topicsModel->select([$_SESSION['user']['id']], 'user_id', true);
			$topicsFollowed = $this->topicsModel->selectByFollow([$_SESSION['user']['id']]);
			$messages = function($topic_id){
				$all_messages =$this->messagesModel->select([$topic_id], 'topic_id');
				$countMessages = count($all_messages);
				return $countMessages;
			};

			if(isset($_POST['sub_description'])){
				$edit_description = $_POST['edit_description'];
				if(isset($edit_description)){
					$verifyUser = $this->usersModel->count([$_SESSION['user']['id']], 'user_id', null, 'members_info');
					if($verifyUser == 0){
						$this->usersModel->addInfoUser([$_SESSION['user']['id'], $edit_description]);
					} else {	
						$this->usersModel->updateInfo([
							':description' => $edit_description,
							':id' => $_SESSION['user']['id']
						], 'description');
					}
					
					$this->redirection('profile');
				} 
			}

			if(isset($_POST['sub-resolved'], $_POST['resolved'])){
				if(!empty($_POST['resolved'])){
					$resolved_topic = intval($_POST['resolved']);
					$verifyUser_topic = $this->topicsModel->count([$resolved_topic, $_SESSION['user']['id']], 'id', 'user_id', 'f_topics');
					if($verifyUser_topic == 1){
						$this->topicsModel->resolved([$resolved_topic]);
						$this->redirection('profile');
					} else {
						$resolved_errors = "Le topic n'existe pas ou plus";
					}
				} else {
					$resolved_errors = "Veuillez sélectionné un topic";
				}
			}

			if(isset($_POST['sub-unfollow'], $_POST['unfollow'])){
				$unfollowTopic = $_POST['unfollow'];
				if(!empty($unfollowTopic) && intval($unfollowTopic)){
					$verifyUnfollow = $this->followModel->count([$unfollowTopic, $_SESSION['user']['id']], 'topic_id', 'user_id');

					if($verifyUnfollow == 1){
						$this->followModel->delete([$unfollowTopic]);
						$this->redirection('profile');
					}
				}
			}

			$this->render('profile', compact('infoUser', 'user', 'topics', 'resolved_errors', 'messages', 'topicsFollowed'), true);
		} else {
			$this->redirection('login');
		}
	}

	/**
	* Méthode editProfile qui gère l'affichage de la page de modification
	* du profile et vérifie les données envoyées par l'utilisateur
	*/
	public function editProfile(){
		if($this->logged()){
			$user =	$this->usersModel->select([$_SESSION['user']['id']], 'id');

			if(!empty($_POST['edit_name']) && isset($_POST['edit_name']) && $_POST['edit_name'] !== $user->pseudo){
				$edit_name = $_POST['edit_name'];
				if(strlen($edit_name) < 70){
					$nameVerify = $this->usersModel->count([$edit_name], 'pseudo');
					if($nameVerify == 0){
						$this->usersModel->update([
							':pseudo' => $edit_name,
							':id' => $_SESSION['user']['id']
						], 'pseudo');

						$_SESSION['user']['name'] = $edit_name;
						$this->redirection('profile');
					} else {
						$edit_error = 'Le nom d\'utilisateur existe déjà !';
					}
				} else {
					$edit_error = 'Veuillez ne pas dépasser la limite de 70 caractères pour le nom d\'utilisateur !';
				}
			}

			if(!empty($_POST['edit_mail']) && isset($_POST['edit_mail']) && $_POST['edit_mail'] !== $user->mail){
				$edit_mail = $_POST['edit_mail'];
				
				if(filter_var($edit_mail, FILTER_VALIDATE_EMAIL)){
					
					$mailVerify = $this->usersModel->count([$edit_mail], 'mail');
					if($mailVerify == 0){
						
						$this->usersModel->update([
							':mail' => $edit_mail,
							':id' => $_SESSION['user']['id']
						], 'mail');

						$_SESSION['user']['mail'] = $edit_mail;
						$this->redirection('profile');
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

			$this->render('edit_profile', compact('edit_error', 'success'));
		
		} else {
			$this->redirection('login');
		}
	}

	/**
	* Méthode qui gère la modification de l'avatar
	*/
	public function editAvatar(){
		if($this->logged()){
			$user = $this->usersModel->select([$_SESSION['user']['id']], 'id');
			if(isset($_POST['submit_avatar'])){
				if(isset($_FILES['file_avatar']) && !empty($_FILES['file_avatar']['size'])){
					$newAvatar = $_FILES['file_avatar'];
					$ext = strtolower(substr($newAvatar['name'], -3));
					$validate_ext = ['jpg', 'png', 'gif'];
					if($newAvatar['error'] < 1){	
						if(in_array($ext, $validate_ext)){
							$max_size = 2097152;
							if($newAvatar['size'] <= $max_size){
								
								$rename = $_SESSION['user']['id']. '.'. $ext;	
								$tmp_path = $newAvatar['tmp_name'];
								$new_path = 'View/backend/users/avatars/'. $rename;
								$move = move_uploaded_file($tmp_path, $new_path);

								if($move){
									$this->usersModel->update([
										':avatar' => $rename,
										':id' => $_SESSION['user']['id']
									], 'avatar');

									$this->redirection('profile');
								} else {
									$avatarError = 'Une erreur s\'est produite durant le transfert, veuillez réessayer plus tard. Si le problème persiste, merci de bien vouloir nous contacter.';
								}
							} else {
								$avatarError = 'La taille maximum est de 2Mo.';
							}
						} else {
							$avatarError = 'Les extensions autorisées sont jpg | png | gif.';
						}
					} else {
						$avatarError = 'Une erreur est survenue lors de l\'upload';
					}
				} else {
					$avatarError = 'Aucun fichier n\'a été sélectionné';
				}
			}
	
			$this->render('edit_avatar', compact('user', 'avatarError', 'success'));
		} else {
			$this->redirection('login');
		}
	}

	/**
	* Méthode de connexion persistante
	*/
	public function loginCookie(){
		$cookie = explode('-----', $_COOKIE['user']);
		$user = $this->usersModel->select([$cookie[0]], 'id');
		$hashInfo = $user->pseudo . $user->mail . $_SERVER['REMOTE_ADDR'];

		if(password_verify($hashInfo, $cookie[1])){
			$_SESSION['user'] = [
				'id' => $user->id,
				'name' => $user->pseudo,
				'mail' => $user->mail,
				'avatar' => $user->avatar,
				'date' => $user->sub_date_fr,
			];

			$verifyAdmin = $this->adminModel->count([$user->id], 'user_id');
						
			if($verifyAdmin == 1){
				$admin_user = $this->adminModel->select([$user->id], 'user_id');
				if($admin_user->level == 'admin'){
					$_SESSION['admin'] = 'admin';
				} else {
					$_SESSION['contrib'] = 'contrib';
				}
			}
		} else {
			setcookie('user', '', time()-3600);
		}
	}

	/**
	* Méthode qui gère la déconnexion 
	*/
	public function logout(){
		if($this->logged()){
			$_SESSION = array();
			session_destroy();
			setcookie('user', '', time()-3600, '/', null, false, true);
			$this->render('logout');
			$this->redirection('home');
		} else {
			$this->redirection('login');
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