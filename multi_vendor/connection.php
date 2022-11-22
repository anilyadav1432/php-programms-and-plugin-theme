<?php
class database{
    private $host;
    private $username='root';
    private $password='';
    private $database='classDB';
    
    protected function connect()
    {
        $this->host='localhost';
        $this->username='root';
        $this->password='';
        $this->database='classDB';
        $con=new mysqli($this->host,$this->username,$this->password,$this->database);
        return $con;
    }
}
class myClass extends database{
    public function insertData($table,$fields_values)
    {
        if($fields_values!="")
        {
            foreach($fields_values as $key=>$val){
                $fieldArr[]=$key;
                $valueArr[]=$val;
            }
            $field=implode(",",$fieldArr);
            $value=implode("','",$valueArr);
            $value="'".$value."'";
            $sql="insert into $table($field) values($value)";
            // echo $sql;die();
            $result=$this->connect()->query($sql);
            return $result;
        }
    }
    public function selectData($table,$fields='*',$condition="")
    {
        if($condition!="")
        {
            $sql="select $fields from $table $condition ";
            // echo $sql;die();
            $result=$this->connect()->query($sql);
            if($result->num_rows>0)
            {
                $arr=array();
                while($row=$result->fetch_assoc())
                {
                    $arr[]=$row;
                }
            return $arr;
            }
            else
            {
                return 0;
            }
        }
        
    }
}
?>