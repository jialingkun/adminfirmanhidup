<?php
// Upload directory
$target_dir = "upload/";
$target_path = "modul/mod_slider/upload/";

$request = 1;
if(isset($_POST['request'])){
  $request = $_POST['request'];
}

// Upload file
if($request == 1){
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  $msg = "";
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
    $msg = "Successfully uploaded";
  }else{ 
    $msg = "Error while uploading";
  }
  echo $msg;
  exit;
}

// Read files from 
if($request == 2){
  $file_list = array();

  // Target directory
  $dir = $target_dir;
  if (is_dir($dir)){

    if ($dh = opendir($dir)){

      // Read files
      while (($file = readdir($dh)) !== false){

        if($file != '' && $file != '.' && $file != '..'){

          // File path
          $file_path = $target_dir.$file;
          $root_file_path = $target_path.$file;

          // Check its not folder
          if(!is_dir($file_path)){

           $size = filesize($file_path);

           $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$root_file_path);

         }
       }

     }
     closedir($dh);
   }
 }

 echo json_encode($file_list);
 exit;
}

if ($request == 3) {
  if(isset($_POST['filename'])){
    $filename = $_POST['filename'];
    $filePath = $target_dir.$filename;
    if (file_exists($filePath)) {
      unlink($filePath);
      echo "File Successfully Delete."; 
    }else{
      echo "File Not Exist.";
    }
  }else{
    echo "Failed to detect filename";
  }
}

if ($request == 4) {
  include "../../config/koneksi.php";
  $number = $_POST['slideNumber'];
  $url = $_POST['url'];
  $sql=mysqli_query($con,"UPDATE slider_url SET url='$url' WHERE slide_number=$number");
  if ($sql){
    echo "Slide ".$number." berhasil disimpan.";
  }else{
    echo "Link slide tidak berubah.";
  }
}

?>