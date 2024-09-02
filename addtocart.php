<?php

    if(!isset($_GET['id']))
        header("location: home.php");

    require_once("connection.php");
    $sid = session_id();
    $idd=$_SESSION['idd'];
    $query = "select * from carts 
                            where id='$idd' and item_id='{$_GET['id']}'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) //ana aam ello eza mawjoude kermel ma ydall ykarrer instead yzid aal qtt bas
        {$query = "update carts set quantity = quantity + 1 
        where id='$idd' and item_id='{$_GET['id']}'";}
        else
       { //executes the query
    $query = "insert into carts (id, item_id, quantity)
                values('$idd', '{$_GET['id']}', 1)";
                
        }
            mysqli_query($con,$query);
            header ("location: cart.php");
        
                //code executed and sent into cart.php without user seeing it
?>