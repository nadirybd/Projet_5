<?php
namespace Core\Database;
use Core\Database\Database;
use \PDO;
/**
* Classe MysqlDatabase gère les requêtes mysql 
*/
class MysqlDatabase extends Database
{

	/**
	* @param $statement string
	* @param $one / $one = null
	* @return fetch / fetchAll
	*/
	public function query($statement, $one = null){
		$query = $this->getDb()->query($statement);
		
		if($one !== null){
			return $query->fetch(PDO::FETCH_OBJ);
		} else {
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
	}
	
	/**
	* @param $statement string
	* @param $attributes array
	* @param $one / $one = null
	* @param $count / $count = null
	* @return fetch / fetchAll
	*/
	public function prepare($statement, $attributes, $one = null, $all = null){
		$req = $this->getDb()->prepare($statement);
		$req->execute($attributes);
		if($one === true){
			return $req->fetch(PDO::FETCH_OBJ);
		}
		if($all === true){
			return $req->fetchAll(PDO::FETCH_OBJ);
		}  
	}
}