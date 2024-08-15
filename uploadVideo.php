
<?php

if(session_status() !== PHP_SESSION_ACTIVE){
   session_start();
}
include "upload.php";
flush();
ob_flush();
require_once __DIR__.'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$target_dir = "uploads/";
$tempName=rand(100000,900000);
$_SESSION["tempName"]=$tempName;
$target_file = $target_dir . $tempName.".mp4";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('videoQueue', false, true, false, false);



if ($_FILES["fileToUpload"]["size"] > 100000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}
$fileMeta=explode(".",$target_file);
if(!strtolower(end($fileMeta)) =="mp4") {
  $uploadOK=0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, there was an error uploading your file. ".$_FILES["fileToUpload"]["error"];
    session_destroy();
    header("Location: http://videosubtitle/");
die();
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $var1=basename( $_FILES["fileToUpload"]["name"]);
    $_SESSION["originalName"]=$var1;
    $jsonFileMeta=array('tempName'=>$tempName,'originalName'=>$var1);
    $msg1=json_encode($jsonFileMeta);
    $msg2 = new AMQPMessage($msg1);
    $channel->basic_publish($msg2, '', 'videoQueue');
    
  } else {
    echo "Sorry, there was an error uploading your file. ".$_FILES["fileToUpload"]["error"];
    session_destroy();
    header("Location: http://videosubtitle/");
die();
  }
}
?>