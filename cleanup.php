<?php 
$basepath = './uploads';
$realBase = realpath($basepath);

$userpath = $basepath . "/" . $_GET['file'];
$realUserPath = realpath($userpath);

if ($realUserPath === false || strpos($realUserPath, $realBase) !== 0) {
  die();
} else {
  if (!file_exists($realUserPath)) die("Not found");
  unlink($realUserPath);
  echo json_encode(array("success" => true));
  die();  
}


?>
