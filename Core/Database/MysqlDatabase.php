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
	* @return fetch / fetchAll
	*/
	public function prepare($statement, $attributes, $one = null, $all = null){
		$query = $this->getDb()->prepare($statement);
		$data = $query->execute($attributes);

		if($one !== null){
			return $data->fetch(PDO::FETCH_OBJ);
		}
		if($all !== null){
			return $data->fetchAll(PDO::FETCH_OBJ);
		}
	}
}