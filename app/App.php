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
						<div>	'. $content .' </div>
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
	* Méthode URL ENCODED Customize
	* @param string
	* @return string
	*/
	static function encodedUrlCustom($str){
		$url = htmlspecialchars($str);
		$url = preg_replace('#è|é|ê|ë|È|É|Ê|Ë#', 'e', $url);
		$url = preg_replace('#@|À|Á|Â|Ã|Ä|Å|à|á|â|ã|ä|å#', 'a', $url);
		$url = preg_replace('#Ò|Ó|Ô|Õ|Ö|Ø|ò|ó|ô|õ|ö|ø#', 'o', $url);
		$url = preg_replace('#Ì|Í|Î|Ï|ì|í|î|ï#', 'i', $url);
		$url = preg_replace('#Ù|Ú|Û|Ü|ù|ú|û|ü#', 'u', $url);
		$url = preg_replace('#Ç|ç#', 'c', $url);
		$url = preg_replace('#Ñ|ñ#', 'n', $url);
		$url = preg_replace('#Œ|œ#', 'oe', $url);
		$url = preg_replace('#Æ|æ#', 'ae', $url);
		$url = preg_replace('#Ý|Ÿ|ý|ÿ#', 'y', $url);
		$url = preg_replace('#\s|\'|/|\[|\]|{|}|&#', '-', $url);
		$url = preg_replace('#;|\.|,|\?|!#', '', $url);

		return $url;
	}

}