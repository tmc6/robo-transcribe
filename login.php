<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
$mysqli = new mysqli("localhost","root","","robo-translate");
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    $_SESSION["login_error"]=1;
    header("Location: http://videosubtitle/userlogin.php");
    sleep(5);
    die();
    
  }
$username=$_POST["username"];
$password=$_POST["password"];
if (!isset($username) || strlen($username)>10|| !isset($password)){
    $_SESSION["login_error"]=1;
    $mysqli->close();
    sleep(5);
    header("Location: http://videosubtitle/userlogin.php");
    die();
}
else {

$data = $mysqli->prepare("SELECT UserName FROM users where UserName=? AND password=? ;");
$data->bind_param('ss',$username,$password);
$data->execute();
$data->store_result();
if ($data !== false && $data->num_rows == 1) {
    // output data
      $_SESSION["Username"]=$_POST["username"];
      header("Location: http://videosubtitle/");
      die();
    
  } else {
    $_SESSION["login_error"]=1;
    header("Location: http://videosubtitle/userlogin.php");
    die();

  }

$data->close();
$mysqli->close();
}
?>