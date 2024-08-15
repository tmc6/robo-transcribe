<?php
if(session_status() !== PHP_SESSION_ACTIVE){
session_start();
}
if (isset($_SESSION["tempName"])){
    $target_dir = "uploads/subtitledVideos/".$_SESSION["tempName"]."/".$_SESSION["originalName"];
    unlink($target_dir);
    if (!isset($_SESSION["Username"])){
    session_unset();
    }
    header('Location: http://videosubtitle/');
    exit;
}
?>