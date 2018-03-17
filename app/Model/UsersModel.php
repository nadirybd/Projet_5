<?php 
namespace App\Model;
use Core\Model\Model;
/**
* Classe UsersModel prépare ou demande des requêtes 
*/
class UsersModel extends Model
{
	/**
	* Méthode add qui ajoute un utilisateur correctement inscrit
	* @param string -> PDO::Statement 
	*/
	public function add($attributes){
		$this->my_sql->prepare('INSERT INTO members(pseudo, mail, password, avatar) VALUES(:pseudo, :mail, :password, "default.png")', $attributes);
	}

	/**
	* Méthode count qui renvoi le nombre de column
	* @param string -> PDO::Statement 
	* @param string
	*/
	public function count($attributes, $type){
		$count = $this->my_sql->prepare('SELECT count(id) FROM members WHERE '.  $type .' = ?', $attributes, null, null, true);

		return $count;
	}

	/**
	* Méthode count qui renvoi le nombre de column
	* @param string -> PDO::Statement 
	* @param string
	*/
	public function select($attributes, $type){
		$select = $this->my_sql->prepare('SELECT id, pseudo, mail, password FROM members WHERE '. $type .' = ?', $attributes, true);

		return $select;
	}
}