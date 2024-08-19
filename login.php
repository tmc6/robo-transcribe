<?php

session_start();

$timeout = 600;


$mysqli = new mysqli("localhost", "root", "", "Robo-Transcribe");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  $_SESSION["login_error"] = 1;
  header("Location: http://videosubtitle/userlogin.php");

  die();
}
$username = $_POST["username"];
$password = $_POST["password"];
if (!isset($username) || strlen($username) > 10 || !isset($password)) {
  $_SESSION["login_error"] = 1;
  $mysqli->close();
  header("Location: http://videosubtitle/userlogin.php");
  die();
} else {
  $IP = $_SERVER['REMOTE_ADDR'];
  $data = $mysqli->prepare("SELECT `count`,timelog FROM `login-limiter` WHERE IP=? ;");

  $data->bind_param('s', $IP);
  $data->execute();
  $data->store_result();
  $data->bind_result($count, $time2);
  $data->fetch();
  if ($data !== false && $data->num_rows == 1 && isset($time2) && $count == 4 && time() - $time2 < $timeout) {
    $_SESSION["loginTimeout"] = $time2;
    header("Location: http://videosubtitle/userlogin.php");
    die();
  } else {
    if ($data !== false && $data->num_rows == 1 && isset($time2) && time() - $time2 > $timeout) {
      $data = $mysqli->prepare("DELETE FROM `login-limiter` WHERE IP=? ;");
      $data->bind_param('s', $IP);
      $data->execute();
    }
    $data->free_result();
    $data = $mysqli->prepare("SELECT UserName,`Password` FROM users WHERE UserName=?;");
   

  
    $data->bind_param('s', $username);
    $data->execute();
    $data->store_result();
    $data->bind_result($resultUsername,$resultPassword);
    $data->fetch();
    if ($data !== false && $data->num_rows == 1 &&  password_verify($password,$resultPassword)) {

      $_SESSION["Username"] = $username;
      if (isset($_SESSION["loginTimeout"])) {
        unset($_SESSION["loginTimeout"]);
      }
      if (isset($_SESSION["login_error"])) {
        unset($_SESSION["login_error"]);
      }

      header("Location: http://videosubtitle/");
      die();
    } else {

      $_SESSION["login_error"] = 1;
      $data->free_result();
      $data = $mysqli->prepare("SELECT count FROM `login-limiter` WHERE IP=? ;");
      $data->bind_param('s', $IP);
      $data->execute();
      $data->store_result();

      if ($data !== false && $data->num_rows == 0) {
        $data->free_result();
        $data = $mysqli->prepare("INSERT INTO `login-limiter` (IP, `count`) VALUES (?, 1);");

        $data->bind_param('s', $IP);
        $data->execute();
        $data->store_result();


        header("Location: http://videosubtitle/userlogin.php");
        die();
      } else {
        $data->free_result();


        if ($count == 1) {
          $data = $mysqli->prepare("UPDATE `login-limiter` SET `count`=2 WHERE IP=?");
          $data->bind_param('s', $IP);
          $data->execute();
          header("Location: http://videosubtitle/userlogin.php");
          die();
        } elseif ($count == 2) {
          $data = $mysqli->prepare("UPDATE `login-limiter` SET `count`=3 WHERE IP=?");
          $data->bind_param('s', $IP);
          $data->execute();
          header("Location: http://videosubtitle/userlogin.php");
          die();
        } else {
          $data = $mysqli->prepare("UPDATE `login-limiter` SET `count`=4, timelog=? WHERE IP=?");
          $time1 = time();

          $data->bind_param('is', $time1, $IP);
          $data->execute();
          $_SESSION["loginTimeout"] = time();
          header("Location: http://videosubtitle/userlogin.php");
          die();
        }
      }
    }
  }
}
$data->close();
$mysqli->close();
?>