<?php
namespace App\Model;
use Core\Model\Model;
/**
* Classe TopicsModel prépare ou demande des requêtes pour les topics
*/
class TopicsModel extends Model
{
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
	* @return array(Obj stdclass)
	*/
	public function select(){
		$topics = $this->my_sql->query('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") as date_topic, resolved FROM f_topics');

		return $topics;
	}

	/**
	*
	*/
	public function countByCategory($attributes){
		$count = $this->my_sql->prepare('SELECT count(topic_id) FROM f_category_topics WHERE category_id = ?', $attributes, null, null, true);
		return $count;
	}
}