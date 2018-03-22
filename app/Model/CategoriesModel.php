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
			$categories = $this->my_sql->query('SELECT id, name, logo FROM f_category');
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
	public function selectSubCategories($attributes = null, $where = null, $where2 = null){
		if($where === null && $where2 === null){
			$subcategories = $this->my_sql->query('SELECT id, category_id, name FROM f_subcategory');
		} elseif($where !== null && $where2 === null) {
			$subcategories = $this->my_sql->prepare('SELECT id,  category_id, name FROM f_subcategory WHERE ' . $where . '= ?', $attributes, null, true);
		} elseif($where !== null && $where2 !== null) {
			$subcategories = $this->my_sql->prepare('SELECT id, category_id, name FROM f_subcategory WHERE ' . $where . '= ? AND '.$where2.'= ?', $attributes, null, true);
		}

		return $subcategories;
	}

	/**
	*
	*/
	public function insertTopicId($attributes){
		$insert = $this->my_sql->prepare('INSERT INTO f_category_topics(topic_id, category_id, subcategory_id) VALUES(:topic_id, :category_id, :subcategory_id)', $attributes);
		
		return $insert;
	}

}