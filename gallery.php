<?php
echo "Welcome to gallery!<br>";
echo "Our images:<br>";
$dir = './img/';
$n = 1;
if(is_dir($dir)){
	if($dh = opendir($dir)){
		while(($file = readdir($dh)) !== FALSE){
			if($file != 'small' and $file != '.' and $file != '..'){ 
				$images[$n] = $file;
				$n++;
				$img = @imagecreatefromjpeg($dir.$file); 				
				list($w, $h, $type, $attr) = getimagesize($dir.$file);
				if ($w > $h){
					$wbg = 50;
					$wk = $w/$wbg;
					$hbg = $h/$wk;
				}
				else{
					$hbg = 50;
					$hk = $h/$hbg;
					$wbg = $w/$hk;
				}
				$imgbg = @imagecreatetruecolor(50, 50);
				$white = imagecolorallocate($imgbg, 255, 255, 255);
				imagefill($imgbg, 0, 0, $white);
				imagecopyresampled($imgbg, $img, (50-$wbg)/2, (50-$hbg)/2, 0, 0, $wbg, $hbg, $w, $h);
				imagejpeg($imgbg, $dir."small/".$file);
				echo '<a href=watermark.php?img='.$file.'><img src='.$dir.'small/'.$file.' border=1></a> ';
			}
		}
		closedir($dh);
	}
}
$dirsm = $dir.'small/';
if(is_dir($dirsm)){
	if($dhsm = opendir($dirsm)){
		while(($filesm = readdir($dhsm)) !== FALSE){
			if($filesm != '.' and $filesm != '..'){
				if (in_array($filesm,$images) == FALSE)
					unlink($dirsm.$filesm);
			}
		}
		closedir($dhsm);
	}
}
?>
