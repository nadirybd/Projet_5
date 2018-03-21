<?php
use App\Controller\Backend\Users\UsersController as BackUsersController;
/**
* Classe App qui gère des fonctionnalités spécifiques à l'application 
* Web 
*/
class App
{
	/**
	* Méthode load va créer une session et appeler les autoloaders
	*/
	static function load(){
		session_start();	
		require('app/Autoloader.php');
		App\Autoloader::register();
		require('Core/Autoloader.php');
		Core\Autoloader::register();
		
		if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && !isset($_SESSION['user'])){
			BackUsersController::getInstance()->loginCookie();
		}

	}

	/**
	* Méthode sendmail qui va envoyer un mail
	* @param string
	* @param string mail
	* @return function mail
	*/
	static function sendmail($content, $to){
		$header = "MIME-Version: 1.0\r\n";
		$header .= 'From:"nadirybd.ovh"<support@nadirybd.ovh>'."\n";
		$header .= 'Content-Type:text/html; charset="utf-8"'."\n";
		$header .= 'Content-Transfer-Encoding: 8bit';

		$content_mail = '
			<html>
				<body>
					<div>
						<p><img src="http://nadirybd13.000webhostapp.com/images/logo-mail.png" alt="logo"/></p>
						<p>	'. $content .' </p>
						<p>À bientôt sur, <a href="http://localhost/Forum/home" style="color: #0aa2cb;">WebmasterForum</a></p>
						<p>Ceci est un email automatique, veuillez ne pas y répondre</p>
					</div>
				</body>
			</html>
		';

		$send = mail($to, "Forum", $content_mail, $header);

		return $send;
	}

	/**
	*
	*/
	
}