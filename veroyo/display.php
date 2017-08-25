<?php

if(!isset($_SESSION['eid'])){
    session_start();
}

if(!isset($_GET['id'])){
     header("Location: home.php");
    exit();
}
require_once('phpscripts.php');

$vieweid = $_GET['id'];
if(checkifeidexists($vieweid)==0){
    header("Location: home.php");
    exit();
    
}

if($viewid = ''){
    header("Location: home.php");
    exit();
}

require_once('dbconnect.php');
require_once('header.php');
require_once('phpscripts.php');
echo "<div class='mainbodywrapper'>";
profileView($vieweid);
getPosts($vieweid,'oth');

echo "</div>";


?>