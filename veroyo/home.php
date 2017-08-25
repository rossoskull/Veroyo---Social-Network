<?php
session_start();
?>



<?php 
    require_once('dbconnect.php');
    require_once('phpscripts.php');

?>

<?php
if(isset($_POST['submitl'])){
    $eid = mysqli_real_escape_string($dbc,$_POST['leid']);
    $pass =  mysqli_real_escape_string($dbc,$_POST['lpass']);
    $query = "SELECT * FROM users WHERE eid = '$eid'";
    $result = mysqli_query($dbc,$query);
    if($result){
        if(mysqli_affected_rows($dbc)==1){
            $data=mysqli_fetch_array($result);
            if($data['password']==$pass){
                $_SESSION['eid'] = $eid;
                sessionUpdate($data['fname'],$data['lname'],$data['password'],$data['pno'],$data['dateob'],$data['monthob'],$data['yearob'],$data['gender']);
               
                
                
            } else {
                
                 require('header.php');
                echo "                
                <div class='mainbodywrapper'>
                <div class='bodyboxsmall'>
                <form name='wrongpass' action='home.php' method='post' onsubmit='return validateLogin();'>
                <input type='hidden' value='$eid' name='leid'>Password you entered is incorrect.<br>
                <input type='text' id='lpass' name='lpass' class='inp_notclicked' value='Enter Correct Password' onfocus=\"clicked('lpass');\" onblur=\"boxblurred('lpass','Password');\" ><br>
                <input type='submit' name='submitl' id='submitl' value='Try Again'>
                </form>
                </div>
                </div>
                ";
                
            }
        } else {
            require('header.php');
            echo "
            <div class='mainbodywrapper'>
            <div class='bodyboxsmall'>
            <div >The E-Mail you entered is incorrect</div>
             <form name='loginform' action='home.php' method='post' onsubmit='return validateLogin();'>
            <table >
            <tr>
            <td><input type='email' name='leid' id='leid' value='E-Mail ID' class='inp_notclicked' onfocus=\"clicked('leid');\" onblur=\"boxblurred('leid','E-Mail ID');\"></td>
            <td><input type='text' name='lpass' id='lpass' value='Password' class='inp_notclicked' onfocus=\"clicked('lpass');\" onblur=\"boxblurred('lpass','Password');\" ></td>
            <td><input type='submit' name='submitl' id='submitl' value='Log In'></td>
            </tr>    
        
            </table>
            </form>
            </div>
            </div>
            ";           
            
            
        }
        
        
    
    
}
   
}


?>

<?php
if( (isset($_SESSION['eid']) && isset($_SESSION['pass']))){} else {
    header("Location: index.php");
    exit();
    
}
?>

<?php
if(isset($_SESSION['eid']) && isset($_SESSION['pass'])){
    require('header.php');
        echo "    <div class='mainbodywrapper'>";
    
    $eid = $_SESSION['eid'];
    $pass = $_SESSION['pass'];
    
    profileView($eid);
    
    echo "
    <div class='bodyboxfull'>
    <fieldset><legend>New Post </legend>
    <form action='post.php' method='post' enctype='multipart/form-data' onsubmit='return validateNewPost();'>
    <table id='postform_cont'>
    <tr>
    <td ><input type='text' name='upTitle' id='upTitle' class='inp_notclicked' onfocus=\"clicked('upTitle');\" onblur=\"boxblurred('upTitle','Title Of Post');\" value='Title Of Post'/></td></tr>
    <tr><td ><textarea name='upDescr' id='upDescr' rowspan='5' class='inp_notclicked' onfocus=\"clicked('upDescr');\" onblur=\"boxblurred('upTitle','Description');\">Description</textarea></td></tr>
    
    <tr><td>
    <select name='upType' id='upType' class='inp_notclicked' onchange=\"itsText();\">
    <option value='0'>Select Type Of Post</option>
    <option value='audio'>Audio/Music/Recording</option>
    <option value='image'>Photo</option>
    <option value='video'>Video</option>
    <option value='text'>Literature/Text</option>
    
    </td></tr>
    
    <tr>
    <td id='upFileCont'><input type='file' name='upFile' id='upFile' class='inp_notclicked' /></td>
    </tr>
    <input type='hidden' value='$eid' name='uploaderid' />
    <tr><td><input type='submit' name='post' value='Post' class='aButton'></td></tr>
    </table>
    </form>
    </fieldset>
    </div>
    
    
    ";
    
    getPosts($eid,'home');
    
    echo "</div>";
    
    
    
}


?>



<?php require('footer.php'); ?>