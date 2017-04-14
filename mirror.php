<?
		$ext = strrchr($_GET["imgurl"],".");
		$ext = substr($ext,1,strlen($ext)-1);
		
		if($ext == "jpg")$image = imagecreatefromjpeg($_GET["imgurl"]);
		if($ext == "gif"){
			$image_gif = imagecreatefromgif($_GET["imgurl"]);
			$x_gif = @imagesx($image_gif); 
			$y_gif = @imagesy($image_gif);
			$image = imagecreatetruecolor($x_gif,$y_gif);
			imagecopy($image,$image_gif,0,0,0,0,$x_gif,$y_gif);
			imagedestroy($image_gif);
		}
		
		$x = @imagesx($image);
		$y = @imagesy($image);
		$des = imagecreatetruecolor($x,$y);
		
		for($i=0;$i<$x;$i++){
			for($j=0;$j<$y;$j++){
				$color = imagecolorat($image,$i,$j);
				imagesetpixel($des,$x-$i-1,$j,$color);
		 	}
		}
		
		header("Expires: Tue, 11 Jun 1985 05:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0",false);
		header("Pragma: no-cache");
		
		if($ext == "jpg"){
			header("Content-Type: image/jpeg");
			@imagejpeg($des,'',90);
		}
		
		if($ext == "gif"){
			header("Content-Type: image/gif");
			@imagegif($des,'',90);
		}
?>