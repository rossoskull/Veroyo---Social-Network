 function clicked(boxid) {
    var field = document.getElementById(boxid);
    if(field.className == 'inp_notclicked'){
        field.setAttribute('value','');
        field.setAttribute('class','inp_clicked');
        if(boxid == 'pass' || boxid=='lpass'||boxid=='repass'){
            field.setAttribute('type','password');
        }
    }
    
};

function boxblurred(boxid,itsvalue) {
    var field = document.getElementById(boxid);
    if(field.className=='inp_clicked' && field.value==''){
        field.setAttribute('value',itsvalue);
        field.setAttribute('class','inp_notclicked');
        if(boxid=='pass'||boxid=='lpass'||boxid=='repass'){
            field.setAttribute('type','text');
        }
    }
    
};

function validateReg() {
    var x = document.getElementById('fname');
    if(x.value=='First Name'||x.value==''){
        alert('Please enter your First Name');
        x.focus();
        return false;
    }
    
    x = document.getElementById('lname');
    if(x.value=='Last Name'||x.value==''){
        alert('Please enter your Last Name');
        x.focus();
        return false;
    }
    
    x= document.getElementById('eid');
    if(x.value==''){
        alert('Please enter your E-Mail ID');
        x.focus();
        return false;
    }
    
    x = document.getElementById('pass');
    if(x.value=='Password'||x.value==''){
        alert('Please enter a Password');
        x.focus();
        return false;
    }
    
    var y = document.getElementById('repass');
    if(y.value=='Retype Password'||y.value==''){
        alert('Please retype your Password');
        y.focus();
        return false;
    } else {
        if(y.value != x.value){
            alert('Passwords don\'t match');
            y.focus();
            return false;
        }
    }
    
    x = document.getElementById('pno');
    if(x.value ==''||x.value=="Phone Number"||isNaN(x.value)){
        alert('Enter a valid Phone Number');
        x.focus();
        return false;
    }
    
    x = document.getElementById('dateob');
    if(x.value == '0'){
        alert('Select your Date of Birth');
        x.focus();
        return false;
    }
    
    x = document.getElementById('monthob');
    if(x.value == '0'){
        alert('Select your Month of Birth');
        x.focus();
        return false;
    }
    
    x = document.getElementById('yearob');
    if(x.value == '0'){
        alert('Select your Year of Birth');
        x.focus();
        return false;
    }
    
    x = document.getElementById('gender');
    if(x.value == '0'){
        alert('Select your Gender');
        x.focus();
        return false;
    }
};


function validateNewID(){
    var x = document.getElementById('eidagain');
    if(x.value==''||x.value=='New E-Mail ID'){
        alert("Please enter new E-Mail ID");
        x.focus();
        return false;
    }
}


function validateLogin(){
    var x = document.getElementById('leid');
    if(x.value=='' || x.value=='E-Mail ID'){
        alert('Please alert an E-Mail ID');
        x.focus();
        return false;
    }
    
    x = document.getElementById('lpass');
    if(x.value=='' || x.value=='Password'){
        alert('Please enter a password');
        x.focus();
        return false;
    }
}




function itsText(){
    var x= document.getElementById('upType');
    var y= document.getElementById('upFileCont');

    if(x.value=='text'){
        y.setAttribute('style','display:none;');
    } else {
         y.setAttribute('style','display:table-cell;');

        
    }
    
}

function validateNewPost(){
    var x = document.getElementById('upTitle');
    if(x.value == "" || x.value == "Title Of Post"){
        alert("Please enter a Title");
        x.focus();
        return false;
    }
    
    x = document.getElementById('upDescr');
    if((x.value==''||x.value=='Description')&& document.getElementById('upType').value=='text'){
        alert('Please enter a Description.');
        x.focus();
        return false;
    }
    
    x = document.getElementById('upType');
    if(x.value=="0"){
        alert("Please select the type of post.");
        x.focus();
        return false;
    }
    
    
}


function createXmlHttpRequestObject(){
    var xmlHttp;
    
    if(window.ActiveXObject){
        try{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(e){
            xmlHttp = false;
        }
    } else {
        try{
            xmlHttp = new XMLHttpRequest();
        }catch(e){
            xmlHttp = false;
        }
    }
    
    if(!xmlHttp){
        alert("Couldn't create XML HTTP request");
    }
    else {
        return xmlHttp;
    }
    
}