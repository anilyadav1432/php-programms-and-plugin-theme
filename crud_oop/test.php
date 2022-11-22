<?php

include('database.php');

$obj=new query();
//for Insert data code start here

/*
$fields_values=array('name'=>'Sunil','email'=>'s@gmail.com','mobile'=>'34536');
$result=$obj->insertData('user',$fields_values);
if($result>0)
{
    echo "data Inserted";
}
else{
    echo "data not inserted";
}
*/

//for Insert data code end here
//For get data start here

/*
$condition=" name='Anil' or id='2' ";
$result=$obj->getData('user','*',$condition,'id','asc','2');
print_r($result);
*/

// get data code end here
// delete data code start here

/*
$condition=" name='Anil' and id='2' ";
$result=$obj->deleteData('user',$condition);
if($result>0)
{
    echo "data is deleted";
}
else{
    echo "data not deleted";
}
*/
// delete data code end here
// update data code start here

$condition=" id='3' ";
$fields_values=" name='Anil',mobile='1234',email='a@gmail.com' ";
$result=$obj->updateData('user',$condition,$fields_values);
// echo $result; die();
if($result>0)
{
    echo "data is updated";
}
else{
    echo "data not updated";
}

?>