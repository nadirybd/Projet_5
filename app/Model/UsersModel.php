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
		$this->my_sql->prepare('INSERT INTO members(pseudo, mail, password, avatar, subscribe_date) VALUES(:pseudo, :mail, :password, "default.png", NOW())', $attributes);
	}

	/**
	* Méthode update qui met à jour les infos d'un utilisateur
	* @param string -> PDO::Statement 
	*/
	public function update($attributes, $where = null){
		if($where === null){
			$update = $this->my_sql->prepare('UPDATE members SET pseudo = :pseudo, mail = :mail, password = :password WHERE id = :id', $attributes);
		} else {
			$update = $this->my_sql->prepare('UPDATE members SET '. $where .' = :'. $where .' WHERE id = :id', $attributes);
		} 
		return $update;
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
		$select = $this->my_sql->prepare('SELECT id, pseudo, mail, password, avatar, DATE_FORMAT(subscribe_date, "%d/%m/%Y") AS sub_date_fr FROM members WHERE '. $type .' = ?', $attributes, true);

		return $select;
	}

	/**
	* Méthode count qui renvoi le nombre de column
	* @param string -> PDO::Statement 
	* @param string
	*/
	public function selectInfo($attributes){
		$select = $this->my_sql->prepare('
			SELECT members_info.id, members_info.description, members_info.user_id FROM members_info 
			LEFT JOIN members 
				ON members_info.user_id = members.id
			WHERE members.id = ?', $attributes, true);

		return $select;
	}
}