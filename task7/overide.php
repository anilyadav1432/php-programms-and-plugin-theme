<?php
class overrideClass1
{
    static function fun1()
    {
        echo "This is my parent class method";
    }
}
class overrideClass2 extends overrideClass1
{
    static function fun1()
    {
        echo "This is my override class method";
    }
}

$ob=new overrideClass2();
$ob->fun1();
?>