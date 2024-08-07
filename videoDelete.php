<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

if (isset($_SESSION["tempName"])){
    $target_dir = "uploads/subtitledVideos/".$_SESSION["tempName"]."/".$_SESSION["originalName"];
    unlink($target_dir);
    session_unset();
    header('Location: http://videosubtitle/');
    exit;
}
?>