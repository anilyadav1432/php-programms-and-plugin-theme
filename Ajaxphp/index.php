<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mycss.css">
    <title>Document</title>
</head>
<body>
    <form id="formId">
       Name: <input type="text" name="" id="name"><br/>
       Email: <input type="text" name="" id="email"><br/>
       password : <input type="text" name="" id="password"><br/>
        <button id="btn1">Save Data</button>
    </form>
        <div id="appendData"></div>
        <table id="tbl1">

        </table>
        <div id="modal">
            <div id="modal-form">
                <h2>Edit Form</h2>
                <table cellpadding="0" >
                    
                </table>
                <div id="close-btn">X</div>
            </div>
        </div>
   


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
       $(document).ready(function(){
          function loadTable(){
            $.ajax({
                url : "indexCode.php",
                type :"post",
                success : function(data){
                    $('#appendData').html(data);
                }
            });
  
          }

          loadTable();

          $("#btn1").click(function(){
            //   e.preventDefault();
              var name=$("#name").val();
              var email=$("#email").val();
              var password=$("#password").val();
              if(name!="" && email!="")
              {
                $.ajax({
                    url : "FormCode.php",
                    type:"post",
                    data:{name:name,email:email,password:password},
                    success:function(data){
                        $('#formId').trigger(reset);
                        alert(data);
                        loadTable();
                    }
                });
              }else{
                  alert("all field required");
              }
          });


          //For delete
          $(document).on("click",".delete_btn",function(){
            var studentid=$(this).data("id");
            // alert(studentid)
            $.ajax({
                url:"delete.php",
                type:"post",
                data:{id:studentid},
                success:function(data){
                    alert(data);
                    loadTable();
                }
            });
          });

          $(document).on("click",".edit_btn",function(){
            // alert('hii');
            $('#modal').show();
            var studentId=$(this).data("eid");
            $.ajax({
                url:"load-update-form.php",
                type:"post",
                data:{id:studentId},
                success:function(data){
                    $("#modal-form table").html(data);
                }
            })


          });
          $("#close-btn").on("click",function(){
            $('#modal').hide();
          });


          //edit save form 
          $(document).on("click",".edit-submit",function(){
            var studId=$("#edit-id").val();
            var name=$("#edit-name").val();
            var email=$("#edit-email").val();
            var password=$("#edit-password").val();

            $.ajax({
                url:"ajax-update-form.php",
                type:"post",
                data:{id:studId,name:name,email:email,password:password},
                success:function(data){
                    alert(data);
                    $("#modal").hide();
                    loadTable();
                }
            })
          });


        });
    </script>
</body>
</html>