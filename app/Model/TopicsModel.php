<?php
namespace App\Model;
use Core\Model\Model;
/**
* Classe TopicsModel prépare ou demande des requêtes pour les topics
*/
class TopicsModel extends Model
{
	/**
	* @param array(statement)
	* @return lastInsertId
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO f_topics(user_id, title, content, creation_date, user_notif) VALUES(:user_id, :title, :content, NOW(), :user_notif)', $attributes, null, null, null, true);

		return $add;
	}

	/**
	* @param array(statement)
	* @return true / false
	*/
	public function update($attributes, $column){
		$update = $this->my_sql->prepare('UPDATE f_topics SET '.$column.' = :'.$column.', edit_date = NOW() WHERE id = :id', $attributes);

		return $update;
	}

	/**
	* @param null or int
	* @param null or int
	* @return array(Obj stdclass)
	*/
	public function selectBylimit($limit1 = null, $limit2 = null){
		if($limit1 !== null && $limit2 !== null){
			$topics = $this->my_sql->query('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, resolved FROM f_topics ORDER BY creation_date DESC LIMIT '.$limit1.', '.$limit2);
		} elseif($limit1 !== null && $limit2 === null) {
			$topics = $this->my_sql->query('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, resolved FROM f_topics ORDER BY creation_date DESC LIMIT '.$limit1);
		}
		return $topics;
	}

	/**
	* @param null or array(statement)
	* @param null or string
	* @return array(Obj stdclass)
	* @return Obj stdclass
	*/
	public function select($attributes = null, $where = null, $all = null){
		if($where !== null && $all === null){
			$topics = $this->my_sql->prepare('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, resolved, user_notif FROM f_topics WHERE ' . $where .'= ?', $attributes, true);
		} elseif($where !== null && $all !== null){
			$topics = $this->my_sql->prepare('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, resolved, user_notif FROM f_topics WHERE ' . $where .'= ?', $attributes, null, true);
		} else {
			$topics = $this->my_sql->query('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, resolved FROM f_topics ORDER BY creation_date DESC');
		}

		return $topics;
	}

	/**
	* Méthode selectByCategory qui sélectionne par catégorie ou sous-catégorie
	* @param string -> statement
	* @param null or int
	* @param null or int
	* @return array(Obj stdclass)
	*/
	public function selectByCategory($attributes, $where, $limit1 = null, $limit2 = null){
		if($limit1 !== null && $limit2 !== null){
			$topics = $this->my_sql->prepare('
				SELECT f_topics.id, f_topics.user_id, f_topics.title, f_topics.content, DATE_FORMAT(f_topics.creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(f_topics.edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, f_topics.resolved FROM f_topics 
				LEFT JOIN f_category_topics 
					ON f_topics.id = f_category_topics.topic_id
				WHERE  f_category_topics.'. $where .' = ? ORDER BY creation_date DESC LIMIT '.$limit1.', '.$limit2, $attributes, null, true);
		} else {
			$topics = $this->my_sql->prepare('
				SELECT f_topics.id, f_topics.user_id, f_topics.title, f_topics.content, DATE_FORMAT(f_topics.creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(f_topics.edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, f_topics.resolved FROM f_topics 
				LEFT JOIN f_category_topics 
					ON f_topics.id = f_category_topics.topic_id
				WHERE  f_category_topics.'. $where .' = ? ORDER BY creation_date DESC', $attributes, null, true);
		}

		return $topics;
	}

	/**
	* @param array(statement)
	* @return array(Obj stdClass)
	*/
	public function selectByFollow($attributes){
		$selectByFollow = $this->my_sql->prepare('
			SELECT f_topics.id, f_topics.user_id, f_topics.title, f_topics.content, DATE_FORMAT(f_topics.creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, DATE_FORMAT(f_topics.edit_date, "%d/%m/%Y à %Hh%imin%ss") as t_edit_date, f_topics.resolved FROM f_topics 
			LEFT JOIN f_follow
				ON f_follow.topic_id = f_topics.id
			WHERE f_follow.user_id = ?', $attributes, null, true);

		return $selectByFollow; 
	}

	/**
	* @param array(statement)
	* @param null or string
	* @return int
	*/
	public function count($attributes, $where = null, $where2 = null, $table = null){
		if($where !== null && $where2 === null){
			$count = $this->my_sql->prepare('SELECT count(topic_id) FROM f_category_topics WHERE '.$where.' = ?', $attributes, null, null, true);
		} elseif($where !== null && $where2 !== null && $table !== null) {
			$count = $this->my_sql->prepare('SELECT count(id) FROM '.$table.' WHERE '.$where.' = ? AND '.$where2.'= ?' , $attributes, null, null, true);
		}

		return $count;
	}

	/**
	* @param array(statement)
	* @param null or string
	* @return int
	*/
	public function countTopic($attributes, $where, $where2 = null){
		if($where2 !== null){
			$count = $this->my_sql->prepare('SELECT count(id) FROM f_topics WHERE '.$where.' = ? AND '.$where2.'= ?', $attributes, null, null, true);
		} else {
			$count = $this->my_sql->prepare('SELECT count(id) FROM f_topics WHERE '.$where.' = ?', $attributes, null, null, true);
		}

		return $count;
	}

	/**
	* @param int
	* @param null or exist
	* @return array[Obj stdclass] : résultat de la requête 
	*/
	public function lastTopics($limit, $one = null){
		if($one === null){
			$lastTopic = $this->my_sql->query('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") AS date_fr FROM f_topics ORDER BY creation_date DESC LIMIT 0, '. $limit);
		} else {
			$lastTopic = $this->my_sql->query('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") AS date_fr FROM f_topics ORDER BY creation_date DESC LIMIT 0, '. $limit, true);
		}
		return $lastTopic;
	}

	/**
	* @param array(statement)
	* @return true or false
	*/
	public function resolved($attributes){
		$resolved = $this->my_sql->prepare('UPDATE f_topics SET resolved = 1 WHERE id = ?', $attributes);
		return $resolved;
	}
}