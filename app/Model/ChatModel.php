<?php 
namespace App\Model;
use Core\Model\Model;
/**
* Classe ChatModel prépare ou demande des requêtes 
*/
class ChatModel extends Model
{
	/**
	* Méthode select qui selectionne toutes les entrées du wb_chat
	*/
	public function select(){
		$select = $this->my_sql->query('SELECT *, DATE_FORMAT(chat_date, "%d/%m/%Y à %Hh%imin") AS chat_dateFr FROM wb_chat ORDER BY chat_date DESC LIMIT 15');
		return $select;
	}

	/**
	* Méthode add ajoute une entrée dans wb_chat
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO wb_chat(user_id, chat_content, chat_date) VALUES(?, ?, NOW())', $attributes);
		return $add;
	}
}