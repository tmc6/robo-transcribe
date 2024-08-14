<?php 
if(session_status() !== PHP_SESSION_ACTIVE){
 echo "<a id='i8xiu' href='http://videosubtitle/signup.php' class='navbar-menu-link'>Signup</a>";
}
elseif (isset($_SESSION["username"])){
 die();
}
else {
    echo "<a id='i8xiu' href='http://videosubtitle/signup.php' class='navbar-menu-link'>Signup</a>";
}
?> 