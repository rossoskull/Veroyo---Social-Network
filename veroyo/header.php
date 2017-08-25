<header>
<link rel='stylesheet' href='style.css' />
<script src='script.js' ></script>

<div class='wrapper'>

<div id='logo_cont' >
<img src='img-bin/logo.png' height='100%' />
</div>
    

    
<?php if((isset($_POST['regsub'])) || (isset($_POST['submitl'])) || (isset($_SESSION['eid']) && isset($_SESSION['pass']))){
    echo "
    <style>
    header {
    height:40px;
    }
    </style>
    <table id='login_form' height='100%'>
    <tr>
    <td><a href='home.php' class='main_menu_item'>Home</a></td>
    <td><a href='profile.php'>Profile</a></td> 
    <td><a href='logout.php'>Log Out</a></td>
    <td><a href='search.php'>Search</a></td>
    </tr>
    </table>
    
    ";
    
    
    
    
    
    
    
} else {

    echo " <!-- LOGIN FORM -->
    <form name='loginform' action='home.php' method='post' onsubmit='return validateLogin();'>
    <table id='login_form'>
        <tr>
            <td><input type='email' name='leid' id='leid' value='E-Mail ID' class='inp_notclicked' onfocus=\"clicked('leid');\" onblur=\"boxblurred('leid','E-Mail ID');\"></td>
            <td><input type='text' name='lpass' id='lpass' value='Password' class='inp_notclicked' onfocus=\"clicked('lpass');\" onblur=\"boxblurred('lpass','Password');\" ></td>
            <td><input type='submit' name='submitl' id='submitl' value='Log In'></td>
        </tr>    
        
    </table>
    </form>
    
    
<!-- LOGIN FORM ENDS HERE -->";    } ?>
    
    
  
    





</div>
</header>