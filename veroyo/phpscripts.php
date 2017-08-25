<?php



function checkifeidexists($eid){
require('dbconnect.php');
    $query = "SELECT * FROM users WHERE eid = '$eid'";
    $result = mysqli_query($dbc, $query);
    $boolval = mysqli_affected_rows($dbc); 
    return $boolval;

} 

function sessionUpdate($fname,$lname,$pass,$pno,$dateob,$monthob,$yearob,$gender){
    require_once('dbconnect.php');
    $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['pass']=$pass;
        $_SESSION['pno']=$pno;
        $_SESSION['dateob']=$dateob;
        $_SESSION['monthob']=$monthob;
        $_SESSION['yearob']=$yearob;
        $_SESSION['gender']=$gender;        
    
}

function getEIDAgain(){
    
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $pno = $_SESSION['pno'];
    $pass = $_SESSION['pass'];
    $dateob = $_SESSION['dateob'];
    $monthob = $_SESSION['monthob'];
    $yearob = $_SESSION['yearob'];
    $gender = $_SESSION['gender'];
    
    
    
    echo "
    <div class='mainbodywrapper'>
    <div class='bodyboxsmall'>
    <h2>Oops... THe E-Mail ID you entered is already under use, Please enter a new E-Mail ID below.</h2>
    <form name='eidagain' method='post' action='register.php' onsubmit='return validateNewID();' >
    <input type='email' name='eid' id='eidagain' value='New E-Mail ID' class='inp_notclicked' onclick=\"clicked('eidagain');\" onblur=\"boxblurred('eidagain','New E-Mail ID');\"/>
    
    <input type='hidden' name='fname' value='$fname' >
    <input type='hidden' name='lname' value='$lname' >
    <input type='hidden' name='pno' value='$pno' >
    <input type='hidden' name='pass' value='$pass' >
    <input type='hidden' name='dateob' value='$dateob' >
    <input type='hidden' name='monthob' value='$monthob' >
    <input type='hidden' name='yearob' value='$yearob' >
    <input type='hidden' name='gender' value='$gender' >
    <br>
    
    
    
    <input type='submit' name='regsub' id='regsub' value='Submit' >
    </form>
    </div>
    </div>
    ";
}


function logOut(){
    unset($_SESSION['eid']);
    unset($_SESSION['pass']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['pno']);
    unset($_SESSION['dateob']);
    unset($_SESSION['monthob']);
    unset($_SESSION['yearob']);
    unset($_SESSION['gender']);
    header("Location: index.php");
    exit();
}

function getPosts($eid,$loc){
    
    require('dbconnect.php');
    $idquery = "SELECT * FROM users WHERE eid='$eid'  ";
   
        
        
        
    
    $idresult = mysqli_query($dbc,$idquery);
    $fname ='';
    $lname='';
    if($idresult){
    $idarray = mysqli_fetch_array($idresult);
    $fname=$idarray['fname'];
    $lname=$idarray['lname'];
    }
    
    $query = "SELECT * FROM user_posts WHERE eid = '$eid'";
    
    $arrayId='';
     if($loc == 'home'){
        $dquery = "SELECT followed FROM user_relations WHERE follower='$eid'";
        $dresult = mysqli_query($dbc, $dquery);
        $arrayId = mysqli_fetch_array($dresult);

            if( $dresult ){
                $noOfId = count($arrayId);
                $noOfId--;
                for( $i=0 ; $i<$noOfId ; $i++ ){
                    $id = $arrayId[$i];
                    $query = $query." OR eid='$id'";
                    
                    
                }
            }
        }
    
    $result = mysqli_query($dbc,$query);
    
    if($result){
        
        if(mysqli_affected_rows($dbc)==0){
            echo "No posts";
        }
        while($rows = mysqli_fetch_array($result)):
        $title = $rows['title'];
        $descr = $rows['descr'];
        $type = $rows['type'];
        $filePath = $rows['filePath'];
        $peid = $rows['eid'];
        if($peid!==$_SESSION['eid']){
        $nquery = "SELECT fname,lname FROM users WHERE eid='$peid'";
        $nresult = mysqli_query($dbc, $nquery) or exit();
        $nresult = mysqli_fetch_array($nresult);
        $fname = $nresult['fname'];
        $lname = $nresult['lname'];
        }
            
            
        if($type == 'image'){
            echo "
            <div class='bodyboxfull'>
            <h2>$title</h2>
            <h3>"; 
            if(isset($_SESSION['eid'])&&$peid == $_SESSION['eid']){
                echo "You";
            } else { echo "$fname $lname";}
            
            
            echo "</h3>
            <p>$descr</p>
            <div class='post_wrapper'><img src='$filePath' class='post_img' ></img></div>            
            </div>
            ";
        }
        
        if($type=='audio'){
             echo "
            <div class='bodyboxfull'>
            <h2>$title</h2>
            <h3>"; 
            if(isset($_SESSION['eid'])&&$peid == $_SESSION['eid']){
                echo "You";
            } else { echo "$fname $lname";}
            
            
            echo "</h3>
            <p>$descr</p>
            <div class='audio_post_wrapper'><audio src='$filePath' controls='show-all'  ></audio></div>            
            </div>
            ";
            
        }
        
        if($type == 'video'){
             echo "
            <div class='bodyboxfull'>
            <h2>$title</h2>
            <h3>"; 
            if(isset($_SESSION['eid'])&&$peid == $_SESSION['eid']){
                echo "You";
            } else { echo "$fname $lname";}
            
            
            echo "</h3>
            <p>$descr</p>
            <div class='video_post_wrapper'><video src='$filePath' controls='show-all'  ></video></div>            
            </div>
            ";
            
        }
        
        if($type == 'text'){
            echo "
            <div class='bodyboxfull'>
            <h2>$title</h2>
            <h3>"; 
            if(isset($_SESSION['eid'])&&$peid == $_SESSION['eid']){
                echo "You";
            } else { echo "$fname $lname";}
            
            
            echo "</h3>
            <div class='post_wrapper'><p class='post_text'>$descr</p></div>            
            </div>
            ";
        }
        endwhile;
        
    }
    
    
}

function profileView($eid){
    require('dbconnect.php');
    $query = "SELECT * FROM users WHERE eid = '$eid'";
    $result = mysqli_query( $dbc, $query);
    if($result && mysqli_affected_rows($dbc)==1){
        $data = mysqli_fetch_array($result);
        $fname = $data['fname'];
        $lname = $data['lname'];
        $query = "SELECT * FROM user_profile_data WHERE eid='$eid'";
        $result = mysqli_query($dbc, $query);
        if($result && mysqli_affected_rows($dbc)==1){
            $data = mysqli_fetch_array($result);
            $desc = $data['descript'];
            $propic = $data['propicpath'];
            
                        
        }
        
        
    }
    
    $query = "SELECT * FROM user_posts WHERE eid = '$eid'";
    $result = mysqli_query($dbc, $query);
    $posts = mysqli_affected_rows($dbc);
    
    echo "
    <div class='bodyboxfull'>
    <table>
    <tr>
    <td class='pro_pic_cont' > <img src='$propic' id='profilepic'></img></td>
    <td class='name_data_cont' >
    <table>
    <tr><td colspan='3'><b>$fname $lname</b></td></tr>
    <tr><td>Fan of <b>".getNoOfFollowing($eid)."</b></td><td> | <b>".getNoOfFans($eid)."</b> Fans</td><td> | <b>$posts</b> Posts</td></tr></table>
    
    </td>
    </tr>
    </table>
    </div>
    ";
    
    
}

function getNoOfFollowing($eid){
    require("dbconnect.php");
    $query = "SELECT * FROM user_relations WHERE follower = '$eid'";
    $result = mysqli_query($dbc, $query);
    if($result){
        $n = mysqli_affected_rows($dbc);
        return $n;
    }
    
}

function getNoOfFans($eid){
    require("dbconnect.php");
    $query = "SELECT * FROM user_relations WHERE followed = '$eid'";
    $result = mysqli_query($dbc, $query);
    if($result){
        $n = mysqli_affected_rows($dbc);
        return $n;
    }
    
}

function getKeywordsAsSql($array){
    $noOfKeywords = count($array);
    $addquery = "";
    for($i=1;$i<$noOfKeywords;$i++){
        $key = $array[$i];
        $addquery = $addquery."OR m_name LIKE '%$key%' ";
        
    }
    
    return $addquery;

}

?>


