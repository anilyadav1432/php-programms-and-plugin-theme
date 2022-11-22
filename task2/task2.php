<?php

$games = array(
    "Indoor" => array(
        "Chess" => array(
            array(
            "rank" => 1,
            "player" => "Vishwanathan Anand",
            "country" => "India"
            ),
            array(
            "rank" => 2,
            "player" => "Ding Liren",
            "country" => "China"
            ),
            array(
            "rank" => 3,
            "player" => "Magnus Carlsen",
            "country" => "Norway"
            )
        ),
        "Table Tennis" => array(
            array(
            "rank" => 4,
            "player" => "Ma Long",
            "country" => "China"
            ),
            array(
            "rank" => 5,
            "player" => "Timo Boll",
            "country" => "Germany"
            ),
            array(
            "rank" => 6,
            "player" => "Koki Niwa",
            "country" => "Japan"
            )
        )
    ),
    "Outdoor" => array(
        "Cricket" => array(
            array(
            "rank" => 7,
            "player" => "Virat Kohli",
            "country" => "India"
            ),
            array(
            "rank" => 8,
            "player" => "Babar Azam",
            "country" => "Pakistan"
            ),
            array(
            "rank" => 9,
            "player" => "Rohit Sharma",
            "country" => "India"
            )
        ),
        "Swimming" => array(
            array(
            "rank" => 10,
            "player" => "Micheal Phelps",
            "country" => "US"
            ),
            array(
            "rank" => 11,
            "player" => "Mark Spitz",
            "country" => "US"
            ),
            array(
            "rank" => 12,
            "player" => "Ian Thorpe",
            "country" => "Australia"
            )
        )
    )
);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="one.css">
    <title>Games Task2</title>
  </head>
  <body>
    <div class="containerDiv">
        
    <!-- All Players************************** -->
    <h1>All Players</h1>
        <div class="tblDiv1">

            <table class="tbl1" border="1">
                <thead>
                    <tr>
                        <th>Sr.n.</th>
                        <th>Mode</th>
                        <th>Game</th>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                $sn=1;
                   foreach($games as $key1=>$val1)
                   {  
                        foreach($val1 as $key2=>$val2)
                        {
                            foreach($val2 as $key3=>$val3)
                            {
                                    echo "<tr><th scope='row'>{$sn}</th><td>{$key1}</td><td>{$key2}</td><td>{$val3['rank']}</td><td>{$val3['player']}</td><td>{$val3['country']}</td></tr>";      
                                    $sn++;
                            }
                        }
                   }   
                ?>
               
                </tbody>
            </table>
        </div>

        <!-- Swimming All Players*************** -->
        <h1>All Swimming Players</h1>
        <div class="tblDiv2">

            <table class="tbl2" border="1">
                <thead>
                    <tr>
                        <th>Sr.n.</th>
                        <th>Mode</th>
                        <th>Game</th>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                $sn=1;
                   foreach($games as $key1=>$val1)
                   {  
                        foreach($val1 as $key2=>$val2)
                        {
                            foreach($val2 as $key3=>$val3)
                            {
                                if($key2=="Swimming")
                                {
                                    echo "<tr><th scope='row'>{$sn}</th><td>{$key1}</td><td>{$key2}</td><td>{$val3['rank']}</td><td>{$val3['player']}</td><td>{$val3['country']}</td></tr>";      
                                    $sn++;
                                }
                            }
                        }
                   }   
                ?>
               
                </tbody>
            </table>
        </div>

        <!-- India All Players*************** -->
        <h1>All India Players</h1>
        <div class="tblDiv3">

            <table class="tbl3" border="1">
                    
                <?php
                $sn=1;
                   foreach($games as $key1=>$val1)
                   {  
                        foreach($val1 as $key2=>$val2)
                        {
                            foreach($val2 as $key3=>$val3)
                            {
                                if($val3['country']=="India")
                                {
                                    echo "<tr></tr>";
                                    echo "<tr><th>Game</th><td>{$key2}</td></tr><tr><th>Rank</th><td>{$val3['rank']}</td></tr><tr><th>Player</th><td>{$val3['player']}</td></tr><tr></tr>";      
                                    $sn++;
                                }
                            }
                        }
                   }   
                ?>
               
            </table>
        </div>

        <!-- Update Player India With Rank 8*************** -->
        <h1>Update Player India With Rank 8</h1>
        <div class="tblDiv4">

        <table class="tbl4" border="1">
                <thead>
                    <tr>
                        <th>Sr.n.</th>
                        <th>Mode</th>
                        <th>Game</th>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                $sn=1;
                   foreach($games as $key1=>$val1)
                   {  
                        foreach($val1 as $key2=>$val2)
                        {
                            foreach($val2 as $key3=>$val3)
                            {
                                if($val3['rank']==8)
                                {
                                    $val3['country']="India";
                                    echo "<tr><th scope='row'>{$sn}</th><td>{$key1}</td><td>{$key2}</td><td>{$val3['rank']}</td><td>{$val3['player']}</td><td>{$val3['country']}</td></tr>";      
                                    
                                }
                                else
                                {
                                    echo "<tr><th scope='row'>{$sn}</th><td>{$key1}</td><td>{$key2}</td><td>{$val3['rank']}</td><td>{$val3['player']}</td><td>{$val3['country']}</td></tr>";
                                }
                                $sn++;
                            }
                        }
                   }   
                ?>
               
                </tbody>
            </table>
        </div>

        <!-- Delete All China Player*************** -->
        <h1>Delete Player of China</h1>
        <div class="tblDiv5">
        <table class="tbl5" border="1">
                <thead>
                    <tr>
                        <th>Sr.n.</th>
                        <th>Mode</th>
                        <th>Game</th>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                $sn=1;
                   foreach($games as $key1=>$val1)
                   {  
                        foreach($val1 as $key2=>$val2)
                        {
                            foreach($val2 as $key3=>$val3)
                            {
                                if($val3['country']=="China")
                                {
                                    unset($key3);
                                }
                                else
                                {
                                    echo "<tr><th scope='row'>{$sn}</th><td>{$key1}</td><td>{$key2}</td><td>{$val3['rank']}</td><td>{$val3['player']}</td><td>{$val3['country']}</td></tr>";
                                    $sn++;
                                }
                                
                            }
                        }
                   }   
                ?>
               
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="one.js"></script>
  </body>
</html>