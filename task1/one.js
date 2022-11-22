$(document).ready(function(){
    $("#myForm").submit(function(){
        // e.preventDefault();
        var height=$("#height").val();
        var width=$("#width").val();
        if(height=="" || isNaN(height))
        {
            $("#heightErr").html("Please Enter Valid Height Value");
            return false;
        }
        else
        {
            $("#heightErr").html("");
        }
        if(width=="" || isNaN(width))
        {
            $("#widthErr").html("Please Enter Valid Width Value");
            return false;
        }
        else
        {
            $("#widthErr").html("");
        }
        
    });
});