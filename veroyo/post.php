<?php
session_start();


if((isset($_SESSION['eid']) && isset($_SESSION['pass']))&&isset($_POST['post'])){} else { header("Location: index.php"); exit(); }

require_once('dbconnect.php');
require_once('phpscripts.php');

if(isset($_POST['post'])){
    $eid = $_POST['uploaderid'];
    $title = $_POST['upTitle'];
    $type = $_POST['upType'];
    $descr = $_POST['upDescr'];
    if($descr=='Description'){
        $descr='';
    }
    
 
    $nameFile = $_FILES['upFile']['name'];
    $sizeFile = $_FILES['upFile']['size'];
    $typeFile = $_FILES['upFile']['type']; 
    $tmpName = $_FILES['upFile']['tmp_name'];
    $postid = time().rand(0,9999999).rand(0,999999);
    if(!empty($_FILES['upFile']['tmpname'])){
    /*******/
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $typeFile = finfo_file( $fileInfo, $_FILES['upFile']['tmp_name'] );
    /*******/
    }
    
    if($type=='text'){
        $nameFile='notapplicable';
    }
    
    
    if(isset($nameFile)){
        if(!empty($nameFile) ){
            /* ******************* */
            if($_POST['upType']=='image'){
                if(($typeFile=='image/png'||$typeFile=='image/jpeg'||$typeFile=='image/jpg')&& $sizeFile<=3145728){
                    $pathName = 'user_uploads/img-bin/';    
                    $filePath = $pathName.time().rand(1,99999999).rand(1,9999999).$nameFile;
                    $query = "INSERT INTO user_posts VALUES ('$eid','$title','$type','$descr','$filePath','$postid')";
                    $result = mysqli_query($dbc,$query);
                    if($result) {
                      move_uploaded_file($tmpName, $filePath);
                        
                    require_once('header.php');
                    echo "
                        <div class='mainbodywrapper'>
                        <div class='bodyboxfull'> 
                        <h2>Post successfully created!</h2>
                         <h2>$title</h2>
                         <h3>"; 
                         if(isset($_SESSION['eid'])&&$eid == $_SESSION['eid']){
                         echo "You";
                         } else { echo "$fname $lname";}
            
            
                         echo "</h3>
                         <p>$descr</p>
                         <div class='post_wrapper'><img src='$filePath' class='post_img' ></img></div>     
                        </div>
                        </div>
                    
                    ";
                        
                    } else { echo "error";}
                } else {
                    require_once('header.php');
                    
                    echo "
                    <div class='mainbodywrapper'>
                    <div class='bodyboxsmall'>
                    <fieldset>
                    <legend>Oops...Something went wrong!</legend>
                    <h2>The file you uploaded must be a JPG, JPEG or a PNG File</h2>
                    <h3>Maximum file size allowed is 3 MB</h3>
                    
                    <form action='post.php' method='post' onsubmit='' enctype='multipart/form-data' >
                    <table id='postform_cont'>
                    <input type='hidden' name='upTitle' value='$title'/>
                    <tr>
                    <td><input type='file' name='upFile' id='upFile' class='inp_notclicked' s/></td>
                    </tr>
                    <tr><td>
                    <select name='upType' id='upType' class='inp_notclicked' >
                    <option value='0'>Select Type Of File</option>
                    <option value='audio'>Audio/Music/Recording</option>
                    <option value='image' selected='selected'>Photo</option>
                    <option value='video'>Video</option>
                    
                    </td></tr>
                    <input type='hidden' name='upDescr' />
                    <input type='hidden' value='$eid' name='uploaderid' />
                    <tr><td><input type='submit' name='post' value='Post' class='aButton'></td></tr>
                    
                    </table>
                    </form>
                    
                    
                    
                    </fieldset>
                    </div>
                    </div>
                    ";
                    
                }
            }
            /* ******************* */
            
            
            /* ******************* */
            if($_POST['upType']=='audio'){
                if(($typeFile=='audio/mpeg'||$typeFile=='audio/mp3'||$typeFile=='audio/ogg'||$typeFile=='audio/vnd.wav')&& $sizeFile<=(3145728*5)){
                    $pathName = 'user_uploads/aud-bin/';    
                    $filePath = $pathName.time().rand(1,99999999).rand(0,99999999).$nameFile;
                    $query = "INSERT INTO user_posts VALUES ('$eid','$title','$type','$descr','$filePath','$postid')";
                    $result = mysqli_query($dbc,$query);
                    if($result) {
                      move_uploaded_file($tmpName, $filePath);
                        
                    require_once('header.php');
                    echo "
                        <div class='mainbodywrapper'>
                        <div class='bodyboxfull'> 
                        <h2>Post successfully created!</h2>
                         <h2>$title</h2>
                         <h3>"; 
                         if(isset($_SESSION['eid'])&&$eid == $_SESSION['eid']){
                         echo "You";
                         } else { echo "$fname $lname";}
            
            
                         echo "</h3>
                         <p>$descr</p>
                         <div class='audio_post_wrapper'><audio src='$filePath' controls='show-all'  ></audio></div>            
           
                        </div>
                        </div>
                    
                    ";
                        
                    } 
                } else {
                    
                     require_once('header.php');
                    
                    echo "
                    <div class='mainbodywrapper'>
                    <div class='bodyboxsmall'>
                    <fieldset>
                    <legend>Oops...Something went wrong!</legend>
                    <h2>The file you uploaded must be a OGG, MP3, MP4( Audio ) or a WAV File</h2>
                    <h3>Maximum file size allowed is 15 MB</h3>
                    
                    <form action='post.php' method='post' onsubmit='' enctype='multipart/form-data' >
                    <table id='postform_cont'>
                    <input type='hidden' name='upTitle' value='$title'/>
                    <tr>
                    <td><input type='file' name='upFile' id='upFile' class='inp_notclicked' s/></td>
                    </tr>
                    <tr><td>
                    <select name='upType' id='upType' class='inp_notclicked' >
                    <option value='0'>Select Type Of File</option>
                    <option value='audio' selected='selected'>Audio/Music/Recording</option>
                    <option value='image'>Photo</option>
                    <option value='video'>Video</option>
                    
                    </td></tr>
                    <input type='hidden' name='upDescr' />
                    <input type='hidden' value='$eid' name='uploaderid' />
                    <tr><td><input type='submit' name='post' value='Post' class='aButton'></td></tr>
                    
                    </table>
                    </form>
                    
                    
                    
                    </fieldset>
                    </div>
                    </div>
                    ";
                    
                    
                }
            }
            /* ******************* */
            
            
            /* ******************* */
            if($_POST['upType']=='video'){
                if(($typeFile=='video/mp4'||$typeFile=='audio/mp4'||$typeFile=='audio/ogg'||$typeFile=='audio/vnd.wav')&&$sizeFile<=33554432){
                    $pathName = 'user_uploads/vid-bin/';    
                    $filePath = $pathName.time().rand(1,99999999).rand(0,99999999).$nameFile;
                    $query = "INSERT INTO user_posts VALUES ('$eid','$title','$type','$descr','$filePath','$postid')";
                    $result = mysqli_query($dbc,$query);
                    if($result) {
                      move_uploaded_file($tmpName, $filePath);
                        
                    require_once('header.php');
                    echo "
                        <div class='mainbodywrapper'>
                        <div class='bodyboxfull'> 
                        <h2>Post successfully created!</h2>
                        <h2>$title</h2>
                        <h3>"; 
                        if(isset($_SESSION['eid'])&&$eid == $_SESSION['eid']){
                        echo "You";
                        } else { echo "$fname $lname";}
            
            
                        echo "</h3>
                        <p>$descr</p>
                        <div class='video_post_wrapper'><video src='$filePath' controls='show-all'  ></video></div>            
                        </div>
                        </div>
                    
                    ";
                        
                    } 
                } else {
                    /* MAKE IT VIDEO UPLOAD ERROR */
                     require_once('header.php');
                    
                    echo "
                    <div class='mainbodywrapper'>
                    <div class='bodyboxsmall'>
                    <fieldset>
                    <legend>Oops...Something went wrong!</legend>
                    <h2>The file you uploaded must be a OGG,s MP4 or a WAV File</h2>
                    <h3>Maximum file size allowed is 32 MB</h3>
                    <form action='post.php' method='post' onsubmit='' enctype='multipart/form-data' >
                    <table id='postform_cont'>
                    <input type='hidden' name='upTitle' value='$title'/>
                    <tr>
                    <td><input type='file' name='upFile' id='upFile' class='inp_notclicked' s/></td>
                    </tr>
                    <tr><td>
                    <select name='upType' id='upType' class='inp_notclicked' >
                    <option value='0'>Select Type Of File</option>
                    <option value='audio' selected='selected'>Audio/Music/Recording</option>
                    <option value='image'>Photo</option>
                    <option value='video'>Video</option>
                    
                    </td></tr>
                    <input type='hidden' name='upDescr' />
                    <input type='hidden' value='$eid' name='uploaderid' />
                    <tr><td><input type='submit' name='post' value='Post' class='aButton'></td></tr>
                    
                    </table>
                    </form>
                    
                    
                    
                    </fieldset>
                    </div>
                    </div>
                    ";
                    
                    
                }
            }
            /* ******************* */
            
            
            /* ******************* */
            if($_POST['upType']=='text'){
                    $filePath = 'notapplicable';
                    $query = "INSERT INTO user_posts VALUES ('$eid','$title','$type','$descr','$filePath','$postid')";
                    $result = mysqli_query($dbc,$query);
                    if($result) {
                                             
                    require_once('header.php');
                    echo "
                        <div class='mainbodywrapper'>
                        <div class='bodyboxfull'> 
                        <h2>Post successfully created!</h2>
                        <h2>$title</h2>
                        <h3>"; 
                        if($eid == $_SESSION['eid']){
                        echo "You";
                        } else { echo "$fname $lname";}
            
            
                        echo "</h3>
                        <div class='post_wrapper'><p class='post_text'>$descr</p></div>     
                        </div>
                        </div>
                    
                    ";
                    
                        
                    } else { echo "*";}
                
            }
            /* ******************* */
            
            
            
        } else {
            echo "Please choose a file.";
        }
    }
    
    
    
    
    
    
    
}




?>