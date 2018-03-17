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
	*/
	public function subscribe(){
		if(isset($_POST['subscribe'])){
			$username = htmlspecialchars($_POST['username']);
			$mail = htmlspecialchars($_POST['mail']);
			$confirm_mail = htmlspecialchars($_POST['confirm_mail']);
			$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
			$confirm_pass = $_POST['confirm_pass'];
			$nameVerify = $this->usersModel->select([$username], 'pseudo');
			$mailVerify = $this->usersModel->select([$mail], 'mail');

			if(!empty($username) && !empty($mail) && !empty($confirm_mail) && !empty($pass) && !empty($confirm_pass)) {
				if(strlen($username) < 70){
					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
						if($mail === $confirm_mail){
							if(password_verify($confirm_pass, $pass)){
								if(count($nameVerify) === 0){
									if(count($mailVerify) === 0){
										$this->usersModel->add([
											':pseudo' => $username,
											':mail' => $mail,
											':password' => $pass
										]);
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
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new UsersController();
		}
		return self::$_instance;
	}
}