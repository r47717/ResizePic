<?php
ini_set('max_execution_time', 200);

function resizePic($src, $dest, $scale) {
  $im1 = imagecreatefromjpeg($src);
  if(!$im1) return;
  
  $src_width = imagesx($im1);
  $src_height = imagesy($im1);

  $dst_width = $src_width / $scale;
  $dst_height = $src_height / $scale;

  $im2 = imagecreatetruecolor($dst_width, $dst_height);

  imagecopyresampled($im2, $im1, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
  imagejpeg($im2, $dest, 75);

  imagedestroy($im1);
  imagedestroy($im2);
}

$srcdir = "./large";
$dstdir = "./small";

$files = scandir($srcdir);
foreach($files as $file) {
  if($file == "." or $file == "..") continue;
  $srcpath = "$srcdir/$file";
  $dstpath = "$dstdir/$file";
  echo "resizing '$srcpath' to '$dstpath'... ";
  resizePic($srcpath, $dstpath, 4);
  echo "done </br>";
  //echo "<img src=$dstpath />";
}


?>
