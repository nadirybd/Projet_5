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
	* Méthode addInfoUser qui ajoute un utilisateur correctement inscrit
	* @param string -> PDO::Statement 
	*/
	public function addInfoUser($attributes){
		$this->my_sql->prepare('INSERT INTO members_info(user_id, description) VALUES(?, ?)', $attributes);
	}

	/**
	* Méthode addRecupPass qui ajoute un utilisateur correctement inscrit
	* @param string -> PDO::Statement 
	*/
	public function addRecupPass($attributes){
		$this->my_sql->prepare('INSERT INTO recup_password(recup_mail, recup_pass) VALUES(?, ?)', $attributes);
	}

	/**
	* Méthode update qui met à jour les infos d'un utilisateur
	* @param string -> PDO::Statement 
	* @param string or null 
	* @param string or null
	*/
	public function update($attributes, $where = null, $where2 = null){
		if(!is_null($where) && $where2 === null){
			$update = $this->my_sql->prepare('UPDATE members SET '. $where .' = :'. $where .' WHERE id = :id', $attributes);
		} elseif(!is_null($where2)) {
			$update = $this->my_sql->prepare('UPDATE members SET '. $where .' = :'. $where .' WHERE '. $where2 .' = :'. $where2, $attributes);
		} else {
			$update = $this->my_sql->prepare('UPDATE members SET pseudo = :pseudo, mail = :mail, password = :password WHERE id = :id', $attributes);
		}
		return $update;
	}

	/**
	* Méthode updateInfo qui met à jour les infos d'un utilisateur
	* @param string -> PDO::Statement 
	*/
	public function updateInfo($attributes, $where = null){
		if($where === null){
			$update = $this->my_sql->prepare('UPDATE members_info SET description = :description WHERE user_id = :id', $attributes);
		} else {
			$update = $this->my_sql->prepare('UPDATE members_info SET '. $where .' = :'. $where .' WHERE user_id = :id', $attributes);
		} 
		return $update;
	}

	/**
	* Méthode updateRecupPass qui met à jour les infos d'un utilisateur
	* @param string -> PDO::Statement 
	*/
	public function updateRecupPass($attributes, $where = null){
		if($where === null){
			$update = $this->my_sql->prepare('UPDATE recup_password SET recup_pass = :recup_pass WHERE recup_mail = :recup_mail', $attributes);
		} else {
			$update = $this->my_sql->prepare('UPDATE recup_password SET '. $where .' = :'. $where .' WHERE recup_mail = :recup_mail', $attributes);
		} 
		return $update;
	}

	/**
	* Méthode select qui renvoi le nombre de column
	* @param string -> PDO::Statement 
	* @param string
	*/
	public function select($attributes, $where){
		$select = $this->my_sql->prepare('SELECT id, pseudo, mail, password, avatar, DATE_FORMAT(subscribe_date, "%d/%m/%Y") AS sub_date_fr FROM members WHERE '. $where .' = ?', $attributes, true);

		return $select;
	}

	/**
	* Méthode select qui renvoi le nombre de column
	* @param string -> PDO::Statement 
	* @param string
	*/
	public function selectNewUsers($limit){
		$selectNewUsers = $this->my_sql->query('SELECT id, pseudo, mail, password, avatar, DATE_FORMAT(subscribe_date, "%d/%m/%Y") AS sub_date_fr FROM members ORDER BY id DESC LIMIT '. $limit);
		return $selectNewUsers;
	}

	/**
	* Méthode selectInfo qui renvoi le nombre de column
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

	/**
	* Méthode count qui renvoi le nombre de column
	* @param string -> PDO::Statement 
	* @param string
	* @param string or null 
	* @param string or null
	*/
	public function count($attributes, $where, $where2 = null, $table = null){
		if($table === null) {
			$count = $this->my_sql->prepare('SELECT count(id) FROM members WHERE '.  $where .' = ?', $attributes, null, null, true);
		} elseif($where2 === null) {
			$count = $this->my_sql->prepare('SELECT count(id) FROM '. $table .' WHERE '.  $where .' = ?', $attributes, null, null, true);
		} else {
			$count = $this->my_sql->prepare('SELECT count(id) FROM '. $table .' WHERE '.  $where .' = ? AND '. $where2 . '= ?', $attributes, null, null, true);
		}

		return $count;
	}

	/**
	* Méthode countByMail qui renvoi le nombre de column
	* @param string -> PDO::Statement 
	* @param string
	*/
	public function countRecupPass($attributes, $where){
		$count = $this->my_sql->prepare('SELECT count(id) FROM recup_password WHERE '.  $where .' = ?', $attributes, null, null, true);

		return $count;
	}

	/**
	* Méthode delete qui supprime une ligne dans la base de donnée
	*/
	public function delete($attributes, $where, $table){
		$delete = $this->my_sql->prepare('DELETE FROM '. $table .' WHERE '. $where .' = ?', $attributes);

		return $delete;
	}

}