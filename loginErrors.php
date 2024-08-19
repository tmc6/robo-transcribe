<?php session_start();
$timeout=600;
if (isset($_SESSION["login_error"]) && !isset($_SESSION["loginTimeout"])) {
    echo "<div id='loginerror'> *Invalid Username or Password </div>";
    unset($_SESSION["login_error"]);
}


elseif (isset($_SESSION["loginTimeout"]) && time() - $_SESSION["loginTimeout"] < $timeout) {
    echo "<div id='loginerror'> *Invalid Username or Password. <br> Maximum Login attempts exceeded please wait 10 minutes.</div>";
    unset($_SESSION["login_error"]);
} 
elseif(isset($_SESSION["loginTimeout"]) && time() - $_SESSION["loginTimeout"] > $timeout) {
    echo "<div id='loginerror'> *Invalid Username or Password </div>";
    unset($_SESSION["login_error"]);
    unset($_SESSION["loginTimeout"]);
}

?>