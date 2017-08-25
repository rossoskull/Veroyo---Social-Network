<?php
if(!(isset($_SESSION['eid']))){
    session_start();
    
}

if(!(isset($_SESSION['eid']))){
    header("Location: index.php");
    exit();
    
}


require('dbconnect.php');

require("phpscripts.php");
require("header.php");




?>
<div class='mainbodywrapper'>
    <div class='bodyboxfull'>
<form action='search.php' method='get'>
    <table id='searchtable'>
        <tr><td id='searchboxcont'><input type='text' name='search' placeholder="Find People" id='searchbox'>
</td>
            <td id='searchsubcont'><input type="submit" value="Go" name='submitsearch' id='searchsub'>
</td></tr>
</table>
</form>
        

<?php
if(isset($_GET['submitsearch'])){
    $searchItem = mysqli_real_escape_string($dbc,$_GET['search']);
    $arrSearch = explode(' ', $searchItem);
    $query="SELECT * FROM users_search WHERE m_name LIKE '%$arrSearch[0]%' ".getKeywordsAsSql($arrSearch);
    $result = mysqli_query($dbc, $query);
    if($result){
        $nResults = mysqli_affected_rows($dbc);
        
        if($nResults==0 || $searchItem==''){
            echo "<h3 id='nOfResultsString'>Found 0 results matching \"$searchItem\". Try searching using something else.";
        } else {
            while($rows = mysqli_fetch_array($result)):
                $id = $rows['eid'];
            if($id==$_SESSION['eid']){ break; }
            $query2 = "SELECT * FROM users WHERE eid = '$id'";
            $result2 = mysqli_query($dbc, $query2);
            $query3 = "SELECT * FROM user_profile_data WHERE eid='$id'";
            $result3 = mysqli_query($dbc, $query3);
            if($result && $result2){
                $result2 = mysqli_fetch_array($result2);
                $result3 = mysqli_fetch_array($result3);
                $firstName = $result2['fname'];
                $lastName = $result2['lname'];
                $propicpath = $result3['propicpath'];
                
                
                echo "
                <a href='display.php?id=$id' class='profile_link'>
                <div class='profile_block'>
                <table>
                <tr>
                <td class='pro_pic_cont' > <img src='$propicpath' class='profilepic'></img></td>
                <td class='name_data_cont' >
                <td colspan='3'><b>$firstName $lastName</b></td>
                </tr>
                </table>
                </div>
                <a>
                <hr class='sep'>
                ";
                
                
            }

            
            endwhile;
        }
            

}
} else {
    
    echo "<h3>Search for people in Veroyo - Enter their name</h3>";
}
        
    
?>
    
    </div>
</div>


<?php

require("footer.php");
?>