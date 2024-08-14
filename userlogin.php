<?php 
if (session_status()==PHP_SESSION_ACTIVE && isset($_SESSION["username"])){
header("http://videosubtitle/");
die();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>login</title>
  <meta name="generator" content="GrapesJS Studio">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta property="og:type" content="website">
  <meta name="robots" content="index,follow">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body id="i6n4i">
  <div class="navbar" id="i69mk3">
    <div data-gjs="navbar" class="navbar-container" id="iwtvcs">
      <div class="navbar-burger">
        <div class="navbar-burger-line"></div>
        <div class="navbar-burger-line"></div>
        <div class="navbar-burger-line"></div>
      </div><img src="assets/untitled_removebg_preview_1_.png" id="ijh2h5" />
      <div data-gjs="navbar-items" class="navbar-items-c">
        <nav id="incx" class="navbar-menu"><a id="i8xiu" href="http://videosubtitle/signup.php" class="navbar-menu-link">Signup</a><a id="iqhsu" href="http://videosubtitle/login.php" class="navbar-menu-link">Login</a><a href="http://videosubtitle/help.php" class="navbar-menu-link" id="izpx3g">Help</a><a id="iflwa" class="navbar-menu-link">Contact <span class="tooltiptext">Email: robot-translate@gmail.com</span></a><a href="http://videosubtitle/" id="iflwv" class="navbar-menu-link">Home</a></nav>
      </div>
    </div>
  </div>
  <div id="iaxsrd"></div>
  <section class="gjs-section" id="i8nk8h">
    <div class="gjs-container">
      <form action="login.php" method="post" id="i3y0ym">

        <div id="id1rci"><label id="ipve0z">Username:</label><input name="username" type="text" id="iwo2xf" required></div>
        <div id="pass"><label id="ihdl4o">Password:</label><input name="password" type="password" id="iun6cz" required></div> <?php session_start(); if (isset($_SESSION["login_error"])) {echo "<div id='loginerror'> *Invalid Username or Password </div>"; unset($_SESSION["login_error"]); }?> <input type="submit" value="Login" id="iv2s8q" />

      </form>
    </div>
  </section>
</body>

</html>