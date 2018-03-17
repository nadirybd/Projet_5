<?php 
namespace App\Model;
use Core\Model\Model;
/**
* Classe UsersModel prépare ou demande des requêtes 
*/
class UsersModel extends Model
{
	/**
	* Méthode add qui ajoute un utilisateur correctement inscrit 
	*/
	public function add($attributes){
		$this->my_sql->prepare('INSERT INTO members(pseudo, mail, password, avatar) VALUES(:pseudo, :mail, :password, "default.png")', $attributes);
	}

	public function count($attributes, $type){

		$count = $this->my_sql->prepare('SELECT count(id) FROM members WHERE '.  $type .' = ?', $attributes, null, null, true);

		return $count;
	}
}