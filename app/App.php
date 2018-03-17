<?php
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
	}

	static function url($url){
		echo 'index.php?p='. $url;
	}
}