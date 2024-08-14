<?php
if (session_status()==PHP_SESSION_NONE){
    session_start();  
}

if (isset($_SESSION["EmailValid"]) && $_SESSION["EmailValid"]=="Invalid"){
    echo "<div id='emailerrorFlex'><input maxlength='20' class='smaller' name='email' type='email' required id='email-input'/><p id='emailmsg'>*Email already registered or invalid.</p></div><p id='emailxmark'>&#10006;</p>";
    unset($_SESSION["EmailValid"]);
}
else {
    echo "<div id='emailerrorFlex'><input class='smaller' maxlength='20' name='email' type='email' required id='email-input'/></div><p id='emailxmark'></p>";
}
?>
