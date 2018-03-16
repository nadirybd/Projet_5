<?php
namespace App\Model;
use Core\Model\Model;
/**
* Classe TopicsModel prépare ou demande des requêtes pour les topics
*/
class TopicsModel extends Model
{
	public function lastTopic(){
		$lastTopic = $this->my_sql->query('SELECT id, user_id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%ss") AS date_fr FROM f_topics ORDER BY creation_date DESC LIMIT 0, 1', true);
		
		return $lastTopic;
	}
}