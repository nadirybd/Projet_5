<?php 
namespace App\Model;
use Core\Model\Model;
/**
* Classe FollowModel prépare ou demande des requêtes 
*/
class FollowModel extends Model
{
	/**
	* Méthode add qui lie un utilisateur au topic suivi
	* @param string -> PDO::Statement 
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO f_follow(user_id, topic_id) VALUES(?, ?)', $attributes);
		return $add;
	}

	/**
	* Méthode select qui sélectionne une ou plusieurs entrées dans la 
	* table f_follow
	* @param array(statement)
	* @return array(Obj stdclass)
	*/
	public function count($attributes, $where, $where2 = null){
		if($where2 !== null){
			$count = $this->my_sql->prepare('SELECT count(id) FROM f_follow WHERE '. $where .' = ? AND ' .$where2.' = ?', $attributes, null, null, true);
		} else {
			$count = $this->my_sql->prepare('SELECT count(id) FROM f_follow WHERE '. $where .'= ?', $attributes, null, null, true);
		}

		return $count;
	}
}