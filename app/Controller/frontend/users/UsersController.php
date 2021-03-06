<?php
namespace App\Controller\Frontend\Users;
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
	protected $viewPath = 'frontend/users';
	private static $_instance;
	/**
	* Méthode subscribe qui gère l'affichage de la page d'inscription
	* Et vérifie les données envoyées par l'utilisateur
	*/
	public function subscribe(){
		if(isset($_POST['subscribe'], $_POST['username'], $_POST['mail'], $_POST['confirm_mail'], $_POST['pass'], $_POST['confirm_pass'])){
			$username = $_POST['username'];
			$mail = $_POST['mail'];
			$confirm_mail = $_POST['confirm_mail'];
			$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
			$confirm_pass = $_POST['confirm_pass'];
			$nameVerify = $this->usersModel->count([$username], 'pseudo');
			$mailVerify = $this->usersModel->count([$mail], 'mail');

			if(!empty($username) && !empty($mail) && !empty($confirm_mail) && !empty($pass) && !empty($confirm_pass)) {
				if(strlen($username) < 70){
					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
						if($mail === $confirm_mail){
							if(password_verify($confirm_pass, $pass)){
								if($nameVerify == 0){
									$regexname = preg_match('#^[a-zA-Z0-9]+$#', $username);
									if($regexname == 1){
										if($mailVerify == 0){
											$this->usersModel->add([
												':pseudo' => $username,
												':mail' => $mail,
												':password' => $pass
											]);
											$this->redirection('login');
										} else {
											$error = 'L\'adresse mail existe déjà !';
										}
									} else {
										$error = 'Le nom d\'utilisateur ne peut comporter que des caractères alphanumériques !';
									}
								} else {
									$error = 'Le nom d\'utilisateur existe déjà !';
								}
							} else {
								$error = 'Les mots de passes ne correspondent pas !';
							}
						} else {
							$error = 'Les adresses mail ne correspondent pas !';
						}
					} else {
						$error = 'Veuillez mettre l\'adresse mail au bon format !';
					}
				} else {
					$error = 'Le nom d\'utilisateur ne peut dépasser 70 caractères !';
				}
			} else {
				$error = 'Veuillez remplir tous les champs !';
			}
		}

		$this->render('subscribe', compact('error'));
	}

	/**
	* Méthode qui gère la connexion d'un utilisateur
	* Et stocke les informations dans une session
	*/
	public function login(){
		if(isset($_POST['login'], $_POST['log_user'], $_POST['log_pass'])){
			$log_user = $_POST['log_user'];
			$log_pass = $_POST['log_pass'];
			if(!empty($log_user) && !empty($log_pass)){
				if(filter_var($log_user, FILTER_VALIDATE_EMAIL)){
					$user = $this->usersModel->select([$log_user], 'mail');
				} else {
					$user = $this->usersModel->select([$log_user], 'pseudo'); 
				}
				if($user){
					if(password_verify($log_pass, $user->password)){
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

						if(isset($_POST['log_remember'])){
							$cookie_content = $user->id . '-----';
							$cookie_content .= password_hash($user->pseudo . $user->mail . $_SERVER['REMOTE_ADDR'], PASSWORD_BCRYPT);

							setcookie('user', $cookie_content, time()+60*60*24*30, '/', null, false, true);
						}	

						$this->redirection('profile');
					} else {
						$log_error = 'Mot de passe incorrect !';
					}
				} else {
					$log_error = 'Identifiant incorrect !';
				}
			} else {
				$log_error = 'Veuillez remplir tous les champs !';
			}
		}

		$this->render('login', compact('log_error'));
	}

	/**
	* Méthode recuperation qui gère l'affichage et le traitement des 
	* données pour l'envoi du code de récupération par mail
	*/
	public function recuperation(){
		if(isset($_POST['send_mail'], $_POST['to_mail'])){
			$mail = $_POST['to_mail'];
			if(!empty($mail)){
				if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
					$verifyMail = $this->usersModel->count([$mail], 'mail');
					if($verifyMail == 1){						
						$generate_code = '';
						for ($i=0; $i < 8; $i++) { 
							$generate_code .= mt_rand(0,9);
						}

						$verifyRecup = $this->usersModel->countRecupPass([$mail], 'recup_mail', null, 'recup_password');
						if($verifyRecup == 0){
							$this->usersModel->addRecupPass([$mail, $generate_code]);	
						} else {
							$this->usersModel->updateRecupPass([
								':recup_pass' => $generate_code,
								':recup_mail' => $mail
							], 'recup_pass');
						}
						$content = 'Voici votre code de récupération : ';
						$content .= $generate_code;

						$send = \App::sendmail($content, $mail);
						
						if($send){
							$_SESSION['recup_mail'] = $mail;
							$success = "Un code de récupération vous a été envoyé !";
						} else {
							$error = "Une erreur s'est produite lors de l'envoi du mail !";
						}
					} else {
						$error = 'l\'adresse mail n\'existe pas !';
					}
				} else {
					$error = 'L\'adresse mail n\'est pas au bon format !';
				}
			} else {
				$error = 'Veuillez remplir tous les champs !';
			}
		}
		$this->render('recuperation', compact('success', 'error'));
	} 

	/**
	* Méthode recuperation qui gère l'affichage et le traitement des 
	* données pour l'envoi du code de récupération par mail
	*/
	public function nextRecuperation(){
		if(isset($_POST['send_code'], $_POST['recup_code'])){
			$recup_code = $_POST['recup_code'];
			if(!empty($recup_code)){
				if(isset($_SESSION['recup_mail'])){
					$mail = $_SESSION['recup_mail'];
					$verifyCode = $this->usersModel->count([$mail, $recup_code], 'recup_mail', 'recup_pass', 'recup_password');
					if($verifyCode == 1){
						$this->usersModel->updateRecupPass([
							':validate' => true, 
							':recup_mail' => $_SESSION['recup_mail']]
							,'validate');

						$this->redirection('reset-password');
					} else {
						$error = 'Le code est incorrect !';
					}
				} else {
					$error = 'Votre code à expiré ou est incorrect, merci de bien vouloir renvoyer une demande de récupération.';
				}
			} else {
				$error = 'Veuillez remplir le champs.';
			}
		}
		$this->render('recuperation-code', compact('error', 'success'));
	}

	/**
	* Méthode recuperation qui gère l'affichage et le traitement des 
	* données pour le changement de mot de passe
	*/
	public function resetPassword(){
		$validateCode = $this->usersModel->count([$_SESSION['recup_mail'], '1'], 'recup_mail', 'validate', 'recup_password');
		if($validateCode == 1){
			if(isset($_POST['send_reset'])){	
				$reset_pass = password_hash($_POST['reset_pass'], PASSWORD_BCRYPT);
				$confirm_reset_pass = $_POST['confirm_reset_pass'];
				if(isset($reset_pass, $confirm_reset_pass)){
					if(!empty($reset_pass) && !empty($confirm_reset_pass)){
						if(password_verify($confirm_reset_pass,$reset_pass)){
							$this->usersModel->update([
								':password' => $reset_pass,
								':mail' => $_SESSION['recup_mail']
							], 'password', 'mail');

							$this->usersModel->delete([$_SESSION['recup_mail']], 'recup_mail', 'recup_password');

							$this->redirection('login');
						} else {
							$error = "Les mots de passe ne correspondent pas";
						}
					} else {
						$error = 'Veuillez remplir tous les champs';
					}
				} else {
					$error = 'Une erreur de champs est survenue';
				}
			}
			$this->render('reset-password', compact('error', 'success'));
		} else {
			$this->redirection('recuperation-code');
		}
	}

	/**
	* Méthode publicProfile qui gère l'affichage du profile public 
	*/
	public function publicProfile(){
		if(isset($_GET['pseudo']) && !empty($_GET['pseudo'])){
			$user =	$this->usersModel->select([$_GET['pseudo']], 'pseudo');

			if(is_object($user)){
				if(isset($_SESSION['user']['id'])){
					if($user->id == $_SESSION['user']['id']){
						$this->redirection('profile');
					}
				}
				$infoUser = $this->usersModel->selectInfo([$user->id]);
			} else {
				$this->redirection('webmaster-forum');
			}	
		} else {
			$this->redirection('webmaster-forum');
		}

		$this->render('public-profile', compact('user', 'infoUser'));
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