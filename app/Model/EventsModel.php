<?php 
namespace App\Model;
use Core\Model\Model;
/**
* Classe EventsModel prépare ou demande des requêtes 
*/
class EventsModel extends Model
{
	/**
	* Méthode add
	* @param bool 
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO wb_events(address, title, info, event_date) VALUES(:address, :title, :info, :event_date)', $attributes);
		return $add;
	}

	/**
	* Méthode delete
	* @param bool
	*/
	public function delete($attributes){
		$delete = $this->my_sql->prepare('DELETE FROM wb_events WHERE id = ?', $attributes);
		return $delete;
	}

	/**
	* Méthode update
	* @param bool 
	*/
	public function update($attributes, $where){
		$update = $this->my_sql->prepare('UPDATE wb_events SET '.$where.' = ? WHERE id = ?', $attributes);
		return $update;
	}

	/**
	* Méthode select
	* @return array(Obj stdClass)
	*/
	public function select(){
		$select = $this->my_sql->query('SELECT id, address, title, info, DATE_FORMAT(event_date, "%d/%m/%Y") as event_dateFr FROM wb_events');
		return $select;
	}

	/**
	* Méthode select
	* @return Obj stdClass
	*/
	public function selectById($attributes){
		$selectById = $this->my_sql->prepare('SELECT id, address, title, info, event_date, DATE_FORMAT(event_date, "%d/%m/%Y") as event_dateFr FROM wb_events WHERE id = ?', $attributes, true);
		return $selectById;
	}

	/**
	* Méthode selectByLimit
	* @return array(Obj stdClass)
	*/
	public function selectByLimit($limit, $limit2){
		$select = $this->my_sql->query('SELECT id, address, title, info, DATE_FORMAT(event_date, "%d/%m/%Y") as event_dateFr FROM wb_events ORDER BY event_date DESC LIMIT '.$limit.', '.$limit2);

		return $select;
	}
}