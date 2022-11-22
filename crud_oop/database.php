<?php

class database{
    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;

    protected function connect(){
        $this->host='localhost';
        $this->dbusername='root';
        $this->dbpassword='';
        $this->dbname='crudDb';
        $con=new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
        return $con;
    }
}

class query extends database{
    public function getData($table,$field='*',$condition='',$order_by_field='',$order_by_type='desc',$limit=''){
        $sql="select $field from $table ";

        if($condition!='')
        {
            $sql.=" where $condition ";
           
        }
        if($order_by_field!='')
        {
            $sql.="order by $order_by_field ";
        }
        if($limit!='')
        {
            $sql.="limit $limit ";
        }
        // return $sql;die();
        $result=$this->connect()->query($sql);
        if($result->num_rows>0){
            $arr=array();
            while($row=$result->fetch_assoc())
            {
                $arr[]=$row;
            }
            return $arr;
        }
        else{
            return 0;
        }
        
    }


    // insert data function
    public function insertData($table,$fields_values){

        // return $sql;die();
        
        if($fields_values!=""){
            foreach($fields_values as $key1=>$val1)
            {
               $fieldArr[]=$key1;
               $valueArr[]=$val1;
            }
            $field=implode(",",$fieldArr);
            $value=implode("','",$valueArr);
            $value="'".$value."'";
            $sql="insert into $table($field) values($value)";
            // echo $sql;die();
            $result=$this->connect()->query($sql);
            return $result;
        }
        else{
            return 0;
        }
        
    }

    // delete data function
    public function deleteData($table,$condition){

        // return $sql;die();
        
        if($condition!=""){
            $sql="delete from $table ";
            $sql.=" where $condition ";
        }
        // return $sql;die();
        $result=$this->connect()->query($sql);
            
        if($result>0)
        {
            return $result;
        }
        else{
            return 0;
        }
    }

    // update data function
    public function updateData($table,$condition,$fields_values){

        // return $sql;die();
        
        if($condition!=""){
            $sql="update $table set $fields_values ";
            $sql.=" where $condition ";
        }
        // return $sql;die();
        $result=$this->connect()->query($sql);
            
        if($result>0)
        {
            return $result;
        }
        else{
            return 0;
        }
    }
        
}

?>