<?php 
session_start();
if (isset($_SESSION['Username'])){
echo "<a id='iqhsu' href='http://videosubtitle/logout.php' class='navbar-menu-link'>Logout</a>";
}
else {
echo "<a id='iqhsu' href='http://videosubtitle/userlogin.php' class='navbar-menu-link'>Login</a>";
}
?>