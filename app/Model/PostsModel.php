<?php
namespace App\Model;
use Core\Model\Model;
/**
* Class PostsModel prépare ou demande des requêtes
*/
class PostsModel extends Model
{
	/**
	* Méthode select
	*/
	public function select($attributes = null, $where = null){
		if($where === null){
			$select = $this->my_sql->query('SELECT id, post_title, post_content, post_date, post_img FROM wb_posts');
		} else {
			$select = $this->my_sql->prepare('SELECT id, post_title, post_content, post_date, post_img FROM wb_posts WHERE ' . $where.' = ?', $attributes, true);
		}
		return $select;
	}

	/**
	* Méthode select
	*/
	public function selectByLimit($limit, $limit2){
		$select = $this->my_sql->query('SELECT id, post_title, post_content, post_date, post_img FROM wb_posts ORDER BY post_date ASC limit '.$limit.','.$limit2);

		return $select;
	}

	/**
	* Méthode add
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO wb_posts(post_title, post_content, post_date, post_img) VALUES(:post_title, :post_content, NOW(), :post_img)', $attributes);
		return $add;
	}

	/**
	* Méthode add
	*/
	public function delete($attributes){
		$delete = $this->my_sql->prepare('DELETE FROM wb_posts WHERE id = ?', $attributes);
		return $delete;
	}
}