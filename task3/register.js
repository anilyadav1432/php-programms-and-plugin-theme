$(document).ready(function(){
    $("#myform").submit(function(){
        var name= $("#name").val();
        var email= $("#email").val();
        var password= $("#password").val();
        var address= $("#address").val();
        var city =$("#city").val();
        // alert(city)
        if(name=="" || name.trim()=="")
        {
            $(".nameErr").html("Name Is Required");
            return false;
        }
        else
        {
            var regName= /^[a-zA-Z  ]+$/;
            if(!regName.test(name))
            {
                $(".nameErr").html("Please Enter Valid name");
                return false;
            }
            else
            {
                $(".nameErr").html("");
            }
        }
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
         if(address.length<1)
        {
            $(".addressErr").html("address is required");
            return false;
        }
         else
         {
            $(".addressErr").html("");
         }
         if(city.length<1)
         {
            $(".cityErr").html("city is required");
            return false;
        }
         else
         {
            $(".cityErr").html("");
         }
    });
});