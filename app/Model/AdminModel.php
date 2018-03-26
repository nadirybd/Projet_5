<?php 
namespace App\Model;
use Core\Model\Model;
/**
* Classe AdminModel prépare ou demande des requêtes 
*/
class AdminModel extends Model
{
	/**
	* Méthode add qui lie un utilisateur au l'admin
	* @param string -> PDO::Statement 
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO members_admin(user_id) VALUES(?)', $attributes);
		return $add;
	}

	/**
	* Méthode select qui une entrée ou plusieurs entrées dans la 
	* table members_admin
	* @param array(statement)
	* @return array(Obj stdclass)
	*/
	public function select($attributes, $where){
		$select = $this->my_sql->prepare('SELECT id, user_id, level FROM members_admin WHERE '.$where.' = ?', $attributes, true);

		return $select;
	}

	/**
	* Méthode count qui compte si une entrée existe dans la 
	* table members_admin
	* @param array(statement)
	* @return array(Obj stdclass)
	*/
	public function count($attributes, $where, $where2 = null){
		if($where2 !== null){
			$count = $this->my_sql->prepare('SELECT count(id) FROM members_admin WHERE '. $where .' = ? AND ' .$where2.' = ?', $attributes, null, null, true);
		} else {
			$count = $this->my_sql->prepare('SELECT count(id) FROM members_admin WHERE '. $where .'= ?', $attributes, null, null, true);
		}

		return $count;
	}
}