<?php
if(!isset($_SESSION['eid'])){
    session_start();
}

if(!isset($_SESSION['eid'])&&!isset($_SESSION['pass'])){
    header("Location: index.php");
    exit();
}

require_once('dbconnect.php');
require_once('phpscripts.php');
require_once('header.php');

?>

<?php
if(isset($_POST['profilesave'])){
    require_once('dbconnect.php');
    $fname=$_POST['fname'];
    $lname = $_POST['lname'];
    $reid = $_POST['reid'];
    $descript = $_POST['youdescr'];
    
    $nameFile = $_FILES['pro_pic']['name'];
    $sizeFile = $_FILES['pro_pic']['size'];
    $typeFile = $_FILES['pro_pic']['type']; 
    $tmpName = $_FILES['pro_pic']['tmp_name'];
    $postid = time().rand(0,9999999).rand(0,999999);
    if(!empty($_FILES['pro_pic']['tmpname'])){
    /*******/
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $typeFile = finfo_file( $fileInfo, $_FILES['pro_pic']['tmp_name'] );
    /*******/
    }
    
    if(($typeFile=='image/png'||$typeFile=='image/jpeg'||$typeFile=='image/jpg')){
        $path = "user_uploads/propic_bin/".time().rand(0,9999999).rand(0,9999999).$nameFile;
        move_uploaded_file($tmpName, $path);
        $imgquery = "UPDATE user_profile_data SET propicpath='$path' WHERE eid = '$reid'";
        $result = mysqli_query($dbc, $imgquery);
        
    }
    
    
    $query = "UPDATE users SET fname='$fname', lname='$lname' WHERE eid = '$reid'";
    $result = mysqli_query($dbc,$query);
    
    $query2 = "UPDATE user_profile_data SET descript = '$descript' WHERE eid = '$reid'";
    $result2 = mysqli_query($dbc, $query2);
    
    $query3 = "UPDATE users_search SET m_name = '$fname$lname' WHERE eid = '$reid'";
    $result3 = mysqli_query($dbc, $query3);
    if($result && $result2 && $result3){
        echo "Done";
    }
    
    
}

?>

<?php
$eid = $_SESSION['eid'];
$pass = $_SESSION['pass'];

$query ="SELECT * FROM users WHERE eid = '$eid' ";

$result = mysqli_query($dbc, $query);

if($result){
    if(mysqli_affected_rows($dbc)==1){
        $data = mysqli_fetch_array($result);
        $fname = $data['fname'];
        $lname = $data['lname'];
        
    }
    
$query = "SELECT * FROM user_profile_data WHERE eid = '$eid'";
    
$result = mysqli_query($dbc,$query);
    if($result){
        if(mysqli_affected_rows($dbc)==1){
            $data = mysqli_fetch_array($result);
            $descr = $data['descript'];
        }
    }
    
} else { echo "Can't connect to server";}

echo "
<div class='mainbodywrapper'>
<div class='bodyboxfull'>
<h2>Edit or Add additional information about you.</h2>
<h4>It will be displayed to those who view your profile.</h4>

<form name='' action='' method='post' enctype='multipart/form-data' >
<table class='profile_table'>
<tr><td class='label'>First Name:</td><td class='inputfield'><input type='text' name='fname' id='fname' value='$fname'></td></tr>
<tr><td class='label'>Last Name:</td><td class='inputfield'><input type='text' name='lname' id='lname' value='$lname'></td></tr>
<tr><td class='label'>E-Mail ID:</td><td class='inputfield'> $eid
<input type='hidden' value='$eid' name='reid' >
</td></tr>

<tr><td class='label'>Describe Yourself:</td><td class='inputfield'><textarea name='youdescr' id='youdescr'> $descr </textarea></td></tr>
<tr><td class = 'label'>Profile Picture:</td><td class='inpitfield'><input type='file' name='pro_pic' id='pro_pic' ></td></tr>

<tr><td class='label'></td><td class='inputfield'> <div class='centerwrapper'> <input type='submit' name='profilesave'  id='regsub' value='Save'> </div></td></tr>
</table>
</form>

</div>
</div>
";
?>

<?php
require_once("footer.php");
?>

