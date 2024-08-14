<?php 
if (session_status()==PHP_SESSION_ACTIVE && isset($_SESSION["username"])){
header("http://videosubtitle/");
die();
}
?>
<!doctype html>
<html lang="en">

<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="js/signupValidator.js"></script>
   <meta charset="utf-8">
   <title>Home</title>
   <meta name="generator" content="GrapesJS Studio">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <meta property="og:type" content="website">
   <meta name="robots" content="index,follow">
   <link rel="stylesheet" href="./css/style.css">
</head>

<body id="iau9">
   <div id="iib7" class="navbar">
      <div data-gjs="navbar" id="iniz" class="navbar-container">
         <div id="il3d" class="navbar-burger">
            <div class="navbar-burger-line"></div>
            <div class="navbar-burger-line"></div>
            <div class="navbar-burger-line"></div>
         </div>
         <img id="ifiki" src="assets/untitled_removebg_preview_1_.png" />
         <div data-gjs="navbar-items" class="navbar-items-c">
            <nav id="incx" class="navbar-menu"><?php include "signupButton.php"; include "logoutButton.php"; ?><a href="http://videosubtitle/help.php" class="navbar-menu-link" id="izpx3g">Help</a><a id="iflwa" class="navbar-menu-link">Contact <span class="tooltiptext">Email: robot-translate@gmail.com</span></a><a href="http://videosubtitle/" id="iflwv" class="navbar-menu-link">Home</a></nav>
         </div>
      </div>
   </div>
   <section class="gjs-section" id="ipy1qg">
      <div class="gjs-container">
         <form method="post" action="userSignup.php" id="i4ne3v">

            <div class="grid-container">
               <label id="il0wej">Username:</label>
               <input class="grid-element-signup" name="username" type="text" required id="username-input" />
               <p id="usernamecheckmark">&#10004;</p>
               <p id="usernamexmark">&#10006;</p>
               <label id="iik88i">Email:</label><?php include "emailcheck.php"; ?>

               <label id="izcmhy">Password:</label><div id="pass-inputTip"><input class="password-input" minlength="5"
                  maxlength="13" name="password" type="password" required id="password" /><div class="tooltip" id="tooltip">*Password length between 5-13 characters</div></div>
               <p class="passwordxmark" id="passwordxmark1">&#10006;</p>
               <p class="passwordcheckmark" id="passwordcheckmark1">&#10004;</p>
               <label id="i8muyk">Repeat password:</label><input  class="grid-element-signup" name="passwordRepeat" type="password" minlength="5"
                  maxlength="13" required id="password2" />
               <p class="passwordxmark" id="passwordxmark2">&#10006;</p>
               <p class="passwordcheckmark" id="passwordcheckmark2">&#10004;</p>
            </div>

            <button type="submit" id="submit-signup">Submit</button>
            

         </form>
      </div>
   </section>
</body>

</html>