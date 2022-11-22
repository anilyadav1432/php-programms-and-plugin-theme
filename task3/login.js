$(document).ready(function(){
    $("#loginForm").submit(function(){
        var email= $("#email").val();
        var password= $("#password").val();
        
        //For Email
        if (email.length < 1 || email.trim()=="") {
            $('.emailErr').html('Email is required');
            return false;
        } 
        else if(email!="") {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(email.match(mailformat))
             {
                $('.emailErr').html('');    
            }
            else
            {
                $('.emailErr').html('Please enter valid Email');
                return false;
            }
        }
        if(password.length<6)
        {
            $(".passwordErr").html("password is required atleast 6 Digit");
            return false;
        }
         else
         {
            $(".passwordErr").html("");
         }
         
    });
});