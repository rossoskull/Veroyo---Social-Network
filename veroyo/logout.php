
<?php
session_start();
if(isset($_SESSION['eid'])){
    require_once('phpscripts.php');
    logOut();    
} else {
    header("Location: index.php");
    exit();
}
?>

