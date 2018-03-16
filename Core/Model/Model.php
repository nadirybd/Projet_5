<?php
namespace Core\Model;
/**
* * Classe Parent des différents models
*/
class Model
{
	/**
	* @var stocke une instance de la classe MysqlDatabase
	*/
	protected $my_sql;

	public function __construct(){
		if($this->my_sql === null){
			$this->my_sql = new \Core\Database\MysqlDatabase();
		}
	}
}