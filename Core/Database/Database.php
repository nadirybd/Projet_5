<?php
namespace Core\Database;
use \PDO;
/**
* Classe Database gère la connexion à la base de donnée
*/
class Database
{
	/**
	* @var $db_host stocke l'hôte de la base de donnée
	* @var $db_name stocke le nom de la base de donnée
	* @var $db_user stocke l'utilisateur
	* @var $db_pass stocke le mot de passe 
	*/
	private $db_host;
	private $db_name;
	private $db_user;
	private $db_pass;

	/**
	* @param $dbhost string  
	* @param $dbname string 
	* @param $dbuser string 
	* @param $dbpass string 
	*/
	public function __construct($dbhost = 'localhost', $dbname = 'forum', $dbuser = 'root', $dbpass = 'root'){
		$this->db_host = $dbhost;
		$this->db_name = $dbname;
		$this->db_user = $dbuser;
		$this->db_pass = $dbpass;
	}

	/**
	* Méthode getDb qui créé une connexion à la base de donnée
	* @return $db qui est la connexion
	*/
	protected function getDb(){
		$db = new PDO('mysql:host='. $this->db_host . ';dbname='. $this->db_name.';charset=utf8', $this->db_user, $this->db_pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

		return $db;
	}
}