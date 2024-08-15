<?php 

if(session_status() != 2){
 echo "<a id='i8xiu' href='http://videosubtitle/signup.php' class='navbar-menu-link'>Signup</a>";
}
elseif (!isset($_SESSION["Username"])){
    echo "<a id='i8xiu' href='http://videosubtitle/signup.php' class='navbar-menu-link'>Signup</a>";
}
else {
    echo "<a style='opacity:0;' id='i8xiu' href='http://videosubtitle/signup.php' class='navbar-menu-link'></a>";
}
?> 