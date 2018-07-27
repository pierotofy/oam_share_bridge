<?php 

header('Content-type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Remove old files
$files = glob("./uploads/*");
$now   = time();
foreach ($files as $file){
	if (is_file($file) && $file != ".gitignore"){
		// 2 hours
		if ($now - filemtime($file) >= 60*60*2) unlink($file);
	}
}

$free_space = disk_free_space("./uploads");

// 8 GB
if ($free_space < 8 * 1073741824){
    echo json_encode(array("error" => "Not enough disk space."));
    die();
}


if (count($_FILES) == 1 && isset($_FILES['file']) && $_FILES['file']['type'] == "image/tiff"){
  $filename = uniqid() . ".tif";
  $tmp_name = $_FILES["file"]["tmp_name"];
  if (move_uploaded_file($tmp_name, "./uploads/$filename")){
    echo json_encode(array("url" => dirname($_SERVER['SCRIPT_URI']) . "/download/" . $filename));
  }else{
    echo json_encode(array("error" => "Cannot upload file"));
  }
}else{
  echo json_encode(array("error" => "No file specified"));
}

  
?>
