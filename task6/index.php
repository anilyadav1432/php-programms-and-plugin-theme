
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Task 6</title>
</head>
<body>
    

<div class="mainDiv"> 
    <!-- Abstract Methods code -->
    <h1>Abstraction Output</h1>
    <div class="abstractDiv">
        <?php
            abstract class A1
            {
                public function non_abstract()
                {
                    echo "This  is non_abstract method <br/>";
                }
                public abstract function display1();
                public abstract function display2();
            }

            abstract class A2 extends A1
            {
                public function display1()
                {
                echo "This is abstract method-1<br/>";   
                }
                public abstract function display3();
            }
            class A3 extends A2
            {
                public function display2()
                {
                    echo "This is abstract method-2<br/>";
                }

                public function display3()
                {
                    echo "This is abstract method-3<br/>";
                }
            }

            $ob1=new A3();
            $ob1->non_abstract();
            $ob1->display1();
            $ob1->display2();
            $ob1->display3();
        ?>
    </div>
    <h1>Interface Output</h1>
    <div class="interfaceDiv">
        <?php
            interface Myinterface1
            {
                public function method1();
                public function method2();
            }
            interface Myinterface2 extends Myinterface1
            {
                public function method3();
                public function method4();
            }
            class MyclassName implements Myinterface2
            {
                public function method1()
                {
                    echo "This Interface-1<br/>";
                }
                public function method2()
                {
                    echo "This interface-2 <br/>";
                }
                public function method3()
                {
                    echo "This interface-3 <br/>";
                }
                public function method4()
                {
                    echo "This interface-4<br/>";
                }
            }

            $ob2=new MyclassName();
            $ob2->method1();
            $ob2->method2();
            $ob2->method3();
            $ob2->method4();
        ?>
    </div>
</div>




</body>
</html>