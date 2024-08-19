<?php

function charCheck($str1){
   
    $len=strlen($str1);
    $pattern = "/([A-Za-z\d!@#$%&*?_=+]){".$len."}/i";
    return preg_match($pattern, $str1);
    }

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET["nameCheck"]) && $_GET["nameCheck"] == True && isset($_GET["username"])) {
    $username = $_GET["username"];
    $mysqli = new mysqli("localhost", "root", "", "robo-transcribe");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        $_SESSION["login_error"] = 1;
        header("Location: http://videosubtitle/signup.php");
        die();
    }
    $data = $mysqli->prepare("SELECT UserName FROM users where UserName=? ;");
    $data->bind_param('s', $username);
    $data->execute();
    $data->store_result();
    if ($data !== false && $data->num_rows == 0 &&  charCheck($username)) {
        // output data

        echo "available";
        
    } else {

        echo "unavailable";
        
    }
} else {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    unset($_SESSION["EmailValid"]);
    

    if (isset($_SESSION["Username"]) || !isset($username, $password, $email) || !charCheck($username) ||  !charCheck($password) || strlen($username) <= 2 || strlen($username) > 9 || strlen($password) <= 4 || strlen($password) > 13  || strlen($email) >  320) {
        header("Location: http://videosubtitle/signup.php");
        die();
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    $mysqli = new mysqli("localhost", "root", "", "robo-transcribe");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        $_SESSION["login_error"] = 1;

        header("Location: http://videosubtitle/signup.php");
        die();
    }


    $data = $mysqli->prepare("SELECT UserName FROM users where UserName=? ;");
    $data->bind_param('s', $username);
    $data->execute();
    $data->store_result();
    if ($data !== false && $data->num_rows > 0) {
        echo "unavailable username";
        $data->close();
        $mysqli->close();
        echo "Name fail";
        header("Location: http://videosubtitle/signup.php");
        die();
    }
    $data->free_result();
    $domain = explode('@', $email);
    $domain = $domain[1];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !checkdnsrr($domain, 'MX')) {
        echo "invalid Email";
        $_SESSION["EmailValid"] = "Invalid";
        header("Location: http://videosubtitle/signup.php");
        echo "Email fail";
        $data->close();
        $mysqli->close();
        die();
    }
    $data = $mysqli->prepare("SELECT Email FROM users where Email=? ;");
    $data->bind_param('s', $email);
    $data->execute();
    $data->store_result();
    if ($data !== false && $data->num_rows > 0) {
        
        $_SESSION["EmailValid"] = "Invalid";
        header("Location: http://videosubtitle/signup.php");
        $data->close();
        $mysqli->close();
        die();
    } else {

        $data->free_result();
        $data = $mysqli->prepare("INSERT INTO users (userName,password,Email) VALUES (?,?,?);");
        $data->bind_param('sss', $username, $password, $email);
        $data->execute();
        $data->store_result();
        if ($data) {
            
            header("Location: http://videosubtitle/userlogin.php");
            die();
        }
    }
}
?>