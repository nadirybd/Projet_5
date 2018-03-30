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
	public function select(){
		$select = $this->my_sql->query('SELECT id, post_title, post_content, post_date, post_img FROM wb_posts');
		return $select;
	}

	/**
	* Méthode add
	*/
	public function add($attributes){
		$add = $this->my_sql->prepare('INSERT INTO wb_posts(post_title, post_content, post_date, post_img) VALUES(:post_title, :post_content, NOW(), :post_img)', $attributes);
		return $add;
	}
}