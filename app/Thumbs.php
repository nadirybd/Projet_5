<?php 
namespace App;
/**
* Thumbs créer une nouvelle miniature
*/
class Thumbs 
{
	/**
	* @var
	*/
	private static $_instance;

	/**
	* @param string extension
	* @param string path
	* @param string filename
	*/
	public function getThumb($ext, $source, $filename){
		switch ($ext) {
			case 'jpg':
				$img = imagecreatefromjpeg($source);
				break;
			case 'png':
				$img = imagecreatefrompng($source);
				break;
			case 'gif':
				$img = imagecreatefromgif($source);
				break;
			default:
				break;
		}

		$destination = imagecreatetruecolor(250, 150);

		$img_width = imagesx($img); 
		$img_height = imagesy($img); 
		$to_width = imagesx($destination); 
		$to_height = imagesy($destination);

		imagecopyresampled($destination, $img, 0, 0, 0, 0, $to_width, $to_height, $img_width, $img_height);

		switch ($ext) {
			case 'jpg':
				imagejpeg($destination, 'public/images/posts/thumbs/thumb_'.$filename);
				break;
			case 'png':
				imagepng($destination, 'public/images/posts/thumbs/thumb_'.$filename);
				break;
			case 'gif':
				imagegif($destination, 'public/images/posts/thumbs/thumb_'.$filename);
				break;
			default:
				break;
		}
	}

	/**
	* @return
	*/
	static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new Thumbs();
		}
		return self::$_instance;
	}
}