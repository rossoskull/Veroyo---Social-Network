<?php
if(!isset($_SESSION['eid'])){
session_start();
}

if(isset($_POST['regsub'])){} else {
    header("Location: index.php");
    exit();
    
}
?>

<?php ?>
<?php require_once('dbconnect.php'); ?>

<?php 
if(isset($_POST['regsub'])){
    require_once('phpscripts.php');
    $fname = mysqli_real_escape_string($dbc,$_POST['fname']);
    $lname = mysqli_real_escape_string($dbc,$_POST['lname']);
    $eid = mysqli_real_escape_string($dbc,$_POST['eid']);
    $pass = mysqli_real_escape_string($dbc,$_POST['pass']);
    $pno = mysqli_real_escape_string($dbc,$_POST['pno']);
    $dateob = $_POST['dateob'];
    $monthob = $_POST['monthob'];
    $yearob = $_POST['yearob'];
    $gender = $_POST['gender'];
        
            $propicpath='';

       if($gender=='male'){
                $propicpath = "img-bin/propic_m.png";
            } else if ($gender=='female'){
                $propicpath = "img-bin/propic_f.png";
            }

    
    
    if(checkifeidexists($eid)){
        require('header.php'); 
        if(!(isset($_SESSION['fname']))){session_start();}
        sessionUpdate($fname,$lname,$pass,$pno,$dateob,$monthob,$yearob,$gender);
        getEIDAgain();
        
    } else {
        $query = "INSERT INTO users VALUES ('$fname','$lname','$eid','$pass','$pno','$dateob','$monthob','$yearob','$gender')";
        
        $result = mysqli_query($dbc, $query);


         
            
            $query = "INSERT INTO user_profile_data VALUES ('$eid','','$propicpath')";
            $query2="INSERT INTO users_search VALUES ('$eid', '$fname$lname')";
            $result = mysqli_query($dbc,$query);
            $result2 = mysqli_query($dbc, $query2);
            if($result){
            $_SESSION['eid']= $eid;
            sessionUpdate($fname,$lname,$pass,$pno,$dateob,$monthob,$yearob,$gender);

             header("Location: home.php");
             exit();
            }  else { echo 'gadbad ho gai';}
        }
        
    }



?>

<?php require('footer.php'); ?>
