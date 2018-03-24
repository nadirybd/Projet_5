<?php 
namespace App\Model;
use Core\Model\Model;
/**
* Classe MessagesModel qui communique avec base de donnée
*/
class MessagesModel extends Model
{
	/**
	* Méthode add qui insert une nouvelle entrée dans la table f_message
	* @param $attributes
	* @return true / false
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO f_messages(topic_id, user_id, creation_date, content) VALUES(:topic_id, :user_id, NOW(), :content)', $attributes);
		return $add;
	}

	/**
	* Méthode select qui sélectionne une ou plusieurs entrées dans la 
	* table f_messages
	* @param array(statement)
	* @return array(Obj stdclass)
	*/
	public function select($attributes, $where, $limit = null, $limit2 = null){
		if($limit !== null && $limit2 !== null){
			$messages = $this->my_sql->prepare('SELECT id, topic_id, user_id, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as messageDate, edit_date, best_answer, content FROM f_messages WHERE '. $where .'= ? ORDER BY best_answer DESC, creation_date LIMIT ' .$limit.','.$limit2, $attributes, null, true);
		} else {
			$messages = $this->my_sql->prepare('SELECT id, topic_id, user_id, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as messageDate, edit_date, best_answer, content FROM f_messages WHERE '. $where .'= ?', $attributes, null, true);
		}
		return $messages;
	}

	/**
	* Méthode select qui sélectionne une ou plusieurs entrées dans la 
	* table f_messages
	* @param array(statement)
	* @return array(Obj stdclass)
	*/
	public function count($attributes, $where, $where2 = null){
		if($where2 !== null){
			$count = $this->my_sql->prepare('SELECT count(id) FROM f_messages WHERE '. $where .' = ? AND ' .$where2.' = ?', $attributes, null, null, true);
		} else {
			$count = $this->my_sql->prepare('SELECT count(id) FROM f_messages WHERE '. $where .'= ?', $attributes, null, null, true);
		}

		return $count;
	}

	/**
	* @param array(statement)
	* @return true or false
	*/
	public function updateBestAnswer($attributes){
		$best_answer = $this->my_sql->prepare('UPDATE f_messages SET best_answer = 1 WHERE id = ?', $attributes);
		return $best_answer;
	}
}