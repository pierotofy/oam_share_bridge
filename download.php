<?php 
$basepath = './uploads';
$realBase = realpath($basepath);

$userpath = $basepath . "/" . $_GET['file'];
$realUserPath = realpath($userpath);

// Debug
//$handle = fopen('oam_log.txt', 'a') or die('Cannot open log');
//fwrite($handle, "$_GET[file] --> $_SERVER[REMOTE_ADDR] $_SERVER[HTTP_HOST] $_SERVER[HTTP_USER_AGENT] " . date("h:i:sa") . "\n");
//fclose($handle);

 
if ($realUserPath === false || strpos($realUserPath, $realBase) !== 0) {
    die();
} else {
  if (!file_exists($realUserPath)) die("Not found");
  
  // We guess this is OAM's request to actually download the file
  // by looking at the HTTP_USER_AGENT. If it's CURL, then remove
  // since this is the last request for the file.
  // This will likely break in the future.
  if (stripos($_SERVER['HTTP_USER_AGENT'], 'curl') !== FALSE) register_shutdown_function('unlink', $realUserPath);
  

  ignore_user_abort(true);

  header('Content-type:  image/tiff');
  header('Content-Length: ' . filesize($realUserPath));
  header('Content-Disposition: attachment; filename="' . $_GET['file'] . '"');
  readfile($realUserPath);   
}


?>
