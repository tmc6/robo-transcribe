<?php 
if(session_status() != 2){
 session_start();
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/js/videoReady.js"></script>
    <meta charset="utf-8">
    <title>Upload</title>
    <meta name="generator" content="GrapesJS Studio">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:type" content="website">
    <meta name="robots" content="index,follow">
    

    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body id="ieebk1">
    <title>Home</title>
    <div class="navbar" id="ithoeh">
      <div data-gjs="navbar" class="navbar-container" id="i1xxis">
        <div class="navbar-burger">
          <div class="navbar-burger-line"></div>
          <div class="navbar-burger-line"></div>
          <div class="navbar-burger-line"></div>
        </div><img src="assets/untitled_removebg_preview_1_.png" id="iondqi" />
        <div data-gjs="navbar-items" class="navbar-items-c">
        <nav id="incx" class="navbar-menu"><?php include "signupButton.php"; include "logoutButton.php"; ?><a href="http://videosubtitle/help.php" class="navbar-menu-link" id="izpx3g">Help</a><a id="iflwa" class="navbar-menu-link">Contact <span class="tooltiptext">Email: robot-translate@gmail.com</span></a><a href="http://videosubtitle/" id="iflwv" class="navbar-menu-link">Home</a></nav>
        </div>
      </div>
    </div>
    <div id="i1ydsl">Welcome to Robo-Transcribe!<br /><br /><br /></div>
    <section id="ilml7n" class="gjs-section">
      <div id="i4jo41" class="gjs-container">
        <div id="i9wz66" class="loader"></div>
      </div>
    </section>
    <section id="ia9n44" class="gjs-section">
      <div class="gjs-container">
        <div id="ifxtg9"><span id="i9fa2y">Your video is being processed! When it is ready a download button will appear and a unique link will be generated.</span><br /></div>
      </div>
    </section>
    
  </body>
  
  </html>