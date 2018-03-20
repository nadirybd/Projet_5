<?php
namespace App\Model;
use Core\Model\Model;
/**
* Classe CategoriesModel prépare ou demande des requêtes pour les topics
*/
class CategoriesModel extends Model
{
	/**
	* @param string -> PDO statement
	* @param string
	* @return array[Obj stdclass] : résultat de la requête 
	*/
	public function select($attributes = null, $where = null){
		if($where === null){
			$categories = $this->my_sql->query('SELECT id, name FROM f_category');
		} else {
			$categories = $this->my_sql->prepare('SELECT id, name FROM f_category WHERE ' . $where . '= :'. $where, $attributes, true);
		}

		return $categories;
	}
	
	/**
	* @param string -> PDO statement
	* @param string
	* @return array[Obj stdclass] : résultat de la requête 
	*/
	public function selectSubCategories($attributes = null, $where = null){
		if($where === null){
			$subcategories = $this->my_sql->query('SELECT id, category_id, name FROM f_subcategory');
		} else {
			$subcategories = $this->my_sql->prepare('SELECT id, name FROM f_subcategory WHERE ' . $where . '= ?', $attributes, null, true);
		}

		return $subcategories;
	}


}