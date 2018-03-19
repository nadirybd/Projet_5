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
		if(isset($_POST['subscribe'])){
			$username = htmlspecialchars($_POST['username']);
			$mail = htmlspecialchars($_POST['mail']);
			$confirm_mail = htmlspecialchars($_POST['confirm_mail']);
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
									if($mailVerify == 0){
										$this->usersModel->add([
											':pseudo' => $username,
											':mail' => $mail,
											':password' => $pass
										]);
										header('location: /Forum/login');
									} else {
										$error = 'L\'adresse mail existe déjà !';
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
		if(isset($_POST['login'])){
			$log_user = htmlspecialchars($_POST['log_user']);
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
						header('location: /Forum/profile');
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

	public function recuperation(){
		if(isset($_POST['send_mail'])){
			$mail = htmlspecialchars($_POST['to_mail']);
			if(!empty($mail)){
				if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
					$verifyMail = $this->usersModel->count([$mail], 'mail');
					if($verifyMail == 1){						
						$generate_code = '';
						for ($i=0; $i < 8; $i++) { 
							$generate_code .= mt_rand(0,9);
						}

						$verifyRecup = $this->usersModel->countRecupPass([$mail], 'recup_mail', 'recup_password');
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
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new UsersController();
		}
		return self::$_instance;
	}
}