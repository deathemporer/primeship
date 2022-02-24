function checkFirstForm(theform){
     var email = theform.email.value;

     if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
     }
     return true;
}

function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
}
function isInputNumber(evt){
    var ch = String.fromCharCode(evt.which);
    if(!(/[0-9]/.test(ch))){
          evt.preventDefault();
    }
}
function isNotChar(evt){
    var ch = String.fromCharCode(evt.which);
    if(ch=="'"){
        evt.preventDefault();
    }
}

function blockSpecialChar(e){
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k >= 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 46|| k == 42|| k == 33 || k == 32 || (k >= 48 && k <= 57));
}