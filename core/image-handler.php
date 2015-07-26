<?php
	class Image {
		public function generateMin($img, $targetPath, $mWidth=100,$mHeight=100){
			$name = substr(basename($img), 0,-4);
			$dimension = getimagesize($img);
			if(substr(strtolower($img),-4)==".jpg"){
				$image = imagecreatefromjpeg($img);
			} else if(substr(strtolower($img),-4)==".png"){
				$image = imagecreatefrompng($img);
			} else if(substr(strtolower($img),-4)==".gif"){
				$image = imagecreatefromgif($img);
			} else{
				return false;
			}

			$miniature = imagecreatetruecolor($mWidth, $mHeight);
			if($dimension[0]>($mWidth/$mHeight)*$dimension[1] ){
				$dimY=$mHeight;
				$dimX=$mHeight*$dimension[0]/$dimension[1];
				$decalX=-($dimX-$mWidth)/2; $decalY=0;
			}
			if($dimension[0]<($mWidth/$mHeight)*$dimension[1]){
				$dimX=$mWidth;
				$dimY=$mWidth*$dimension[1]/$dimension[0];
				$decalY=-($dimY-$mHeight)/2;
				$decalX=0;
			}
			if($dimension[0]==($mWidth/$mHeight)*$dimension[1]){
				$dimX=$mWidth;
				$dimY=$mHeight;
				$decalX=0;
				$decalY=0;
			}
			imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
			imagejpeg($miniature,$targetPath."/min_".$name.".jpg",90);
			return true;
		}

		public function createImage() {
			// TODO
		}

	}

?>
