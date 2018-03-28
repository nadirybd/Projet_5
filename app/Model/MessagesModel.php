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
	* Méthode update qui met à jour une entrée dans la table f_message
	* @param $attributes
	* @return true / false
	*/
	public function update($attributes){
		$update = $this->my_sql->prepare('UPDATE f_messages SET edit_date = NOW(), content = ? WHERE id = ?', $attributes);
		return $update;
	}

	/**
	* Méthode updateReport qui met à jour l'entrée report dans la table 
	* f_message
	* @param $attributes
	* @return true / false
	*/
	public function updateReport($attributes, $clean = null){
		if($clean !== null){
			$updateReport = $this->my_sql->prepare('UPDATE f_messages SET report = 0 WHERE id = ?', $attributes);
		} else {
			$updateReport = $this->my_sql->prepare('UPDATE f_messages SET report = report + 1 WHERE id = ?', $attributes);
		}
		return $updateReport;
	}

	/**
	* @param array(statement)
	* @return array(Obj stdClass)
	*/
	public function selectByReport(){
		$selectByReport = $this->my_sql->query('
			SELECT id, topic_id, user_id, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as messageDate, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as edit_dateFr, edit_date, best_answer, content, report FROM f_messages WHERE report > 0 ORDER BY report DESC');

		return $selectByReport; 
	}

	/**
	* Méthode delete qui supprime les entrées par topic_id
	* @param $attributes
	* @return true / false
	*/
	public function delete($attributes){
		$delete = $this->my_sql->prepare('DELETE FROM f_messages WHERE id = ?', $attributes);
		
		return $delete;
	}

	/**
	* Méthode deleteBytopic qui supprime les entrées par topic_id
	* @param $attributes
	* @return true / false
	*/
	public function deleteByTopic($attributes){
		$delete = $this->my_sql->prepare('DELETE FROM f_messages WHERE topic_id = ?', $attributes);
		
		return $delete;
	}
	

	/**
	* Méthode select qui sélectionne une ou plusieurs entrées dans la 
	* table f_messages
	* @param array(statement)
	* @return array(Obj stdclass)
	*/
	public function select($attributes, $where, $limit = null, $limit2 = null){
		if($limit !== null && $limit2 !== null){
			$messages = $this->my_sql->prepare('SELECT id, topic_id, user_id, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as messageDate, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as edit_dateFr, edit_date, best_answer, content FROM f_messages WHERE '. $where .'= ? ORDER BY best_answer DESC, creation_date LIMIT ' .$limit.','.$limit2, $attributes, null, true);
		} else {
			$messages = $this->my_sql->prepare('SELECT id, topic_id, user_id, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as messageDate, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as edit_dateFr, best_answer, content FROM f_messages WHERE '. $where .'= ?', $attributes, null, true);
		}
		return $messages;
	}

	/**
	* Méthode select qui sélectionne une ou plusieurs entrées dans la 
	* table f_messages
	* @param array(statement)
	* @return Obj stdclass
	*/
	public function selectOne($attributes, $where){
		$message = $this->my_sql->prepare('SELECT id, topic_id, user_id, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as messageDate, edit_date, best_answer, content FROM f_messages WHERE '. $where .'= ?', $attributes, true);
		
		return $message;
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