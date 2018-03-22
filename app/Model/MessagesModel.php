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
	public function select($where){
		$messages = $this->my_sql->prepare('SELECT topic_id, user_id, creation_date, edit_date, best_answer, content FROM f_messages WHERE '. $where .'= ?', $attributes, null, true);
		return $messages;
	}
}