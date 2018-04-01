<?php
namespace App;
/**
* Pagination permet de créer une pagination facilement
*/
class Pagination
{
	/**
	* Méthode pagination qui va créer un pagination
	* @return string
	*/
	public function getPage($number_of_page, $href){
		$pagination = '';
		for ($page=1; $page <= $number_of_page ; $page++){
			if($page == $_GET['page']){
				$pagination .= ' | <span>' . $page .'</span> ';
			} else {
				$pagination .='| <a href="'.$href.$page.'">'.$page.'</a> ';
			}
		}
		$pagination = substr($pagination, 2, strlen($pagination));
		return $pagination;
	}

	/**
	* Méthode pagination qui va créer un pagination
	* @return string
	*/
	public function verifyPage($page, $number_of_page, $number_per_page){
		if(isset($page) && intval($page) && $page <= $number_of_page && $page > 0){
			$from = $number_per_page * ($page - 1);
		} else {
			$page = 1;
			$from = $number_per_page * ($page - 1);
		}
		return $from;
	}
}