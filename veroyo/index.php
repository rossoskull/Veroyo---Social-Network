<?php

session_start();

if(isset($_SESSION['eid'])&&isset($_SESSION['pass'])){
    header("Location: home.php");
    exit();
} ?>
<html>
    <head>
       

        
        
        <title></title>
    
    </head>
    <body>
       
        <?php
        require('header.php')
        ?>
    
        <div class='mainbodywrapper'>
            <div class='bodyboxsmall'>
                <h2>You aren't limited just to Photos and Videos, Then why your social network should be?</h2>
                <h3>Join Us and start expanding your presence</h3>
                <form action='register.php' method='post' onsubmit='return validateReg();'>
                <table id='regform_cont' >
                <tr><td><input type='text' value='First Name' id='fname' name='fname' class='inp_notclicked' onfocus="clicked('fname');" onblur="boxblurred('fname','First Name');"/></td>
                    <td><input type='text' value='Last Name' id='lname' name='lname' class='inp_notclicked' onfocus="clicked('lname');" onblur="boxblurred('lname','Last Name');"/></td>
                    </tr>
                <tr><td colspan="2"><input type='email' value='E-Mail ID' id='eid' name='eid' class='inp_notclicked' onfocus="clicked('eid');" onblur="boxblurred('eid','E-Maild ID');"/></td>                    
                    </tr>    
                <tr><td><input type='text' value='Password' id='pass' name='pass' class='inp_notclicked' onfocus="clicked('pass');" onblur="boxblurred('pass','Password');"/></td>
                    <td><input type='text' value='Retype Password' id='repass' name='repass' class='inp_notclicked' onfocus="clicked('repass');" onblur="boxblurred('repass','Retype Password');"/></td>
                    </tr>
                <tr><td colspan="2"><input type='text' value='Phone Number' id='pno' name='pno' class='inp_notclicked' onfocus="clicked('pno');" onblur="boxblurred('pno','Phone Number');"/></td></tr>
                <tr><td colspan="2"></td>
                    </tr>
                <tr><td colspan="2">Date Of Birth:
                    <?php require_once('dateform.php'); ?>                    
                    </td></tr>
                <tr><td><select name='gender' id='gender'>
                    <option value='0'>Select Gender</option>
                    <option value='male'>Male</option>
                    <option value='female'>Female</option>
                    </select></td></tr>
                    <tr><td><div class='centerwrapper'><input type='submit' name='regsub' id='regsub' value='Register'></div></td></tr>
                
                </table>
                </form>
            
            </div>
            
            
        
        </div>
    
    
    
    
    
    
    <?php require_once('footer.php'); ?>
    </body>


</html>
