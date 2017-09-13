<?php
//doc - https://github.com/masterexploder/PHPThumb/wiki/Basic-Usage
require_once(dirname(__FILE__) . '/phpthumb/ThumbLib.inc.php');

class Cithumb{
	
	public function generate_thumb($file,$w=311, $h=465){
		
		list($originalWidth, $originalHeight) = getimagesize($file);
		$ratio = $originalWidth / $originalHeight;
		//$w = $h = min($w, $w);

		//if ($ratio < 1) {
		//	$w = $w * $ratio;
		//} else {
			$h = $h / $ratio;
		//}
		try {
			 $thumb = PhpThumbFactory::create($file);
			 //$thumb->adaptiveResize($w, $h);
			 //$thumb->resizePercent(12);
			 $thumb->resize($w, $h);
			 
			 $path_parts = pathinfo($file);
			 $thumb_file = $path_parts['dirname'].'/'.$path_parts['filename'].'_thumb'.'.'.$path_parts['extension'];
			 $thumb->save($thumb_file);
			 return $path_parts['filename'].'_thumb'.'.'.$path_parts['extension'];
		} catch (Exception $e) {
			return false;
		}
	}
}

