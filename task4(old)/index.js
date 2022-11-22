$(document).ready(function()
{
    $.ajax({
        url:"https://raw.githubusercontent.com/thatisuday/indian-cities-database/master/cities.json",
        type:"get",
        success:function(data)
        {
            var data=JSON.parse(data);
            // console.log(data);
            // debugger
            var arr1=[];
            var stateData=`<option value="">Select State</option>`;
            for(var i=0;i<data.length;i++){
                
                for(let j in data[i])
                {
                    if(!arr1.includes(data[i][j]))
                    {
                        arr1.push(data[i][j]);
                        // console.log(data[i][j]);
                        if(j=="state")
                        {
                            stateData+=`<option value="${data[i][j]}">${data[i][j]}</option>`;
                        }    
                    }     
                }
                // break;
            }
            
            $("#stateId").html(stateData);
        }
    });


    // For City data
    // var cd="";
    $("#stateId").change(function(){
        var state=$("#stateId").val()
        $.ajax({
            url:"citydata.php",
            type:"post",
            data:{state:state},
            success:function(data)
            {
                var data=JSON.parse(data);
                console.log(data);
            }
        });
        // cityData=`<option value="">Select City</option>`;
        // for(var i=0;i<data.length;i++){
        //     // console.log(i);
        //     for(let k in data[i])
        //     {
        //             console.log($("#stateId").val());
        //             if(data[i][k]==$("#stateId").val())
        //             {
        //                 cityData+=`<option value="${k}">${cd}</option>`;
        //                 cd="";
        //             } 
        //             else
        //         {
        //             cd=data[i][k];
        //         }    
        //     }
        //     // break;
        // }
        // $("#cityId").html(cityData);
    });

});