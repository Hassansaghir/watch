<?php
    if(!isset($_GET['id']))
        header("location: index.php");

    require_once("connection.php");
    if(!isset($_SESSION['idd'])){
    header("location: login.php");
    }else{
    $query = "select * from whishlist 
    where client_id='{$_SESSION['idd']}' and item_id='{$_GET['id']}'";    
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) == 0){
        $query = "insert into whishlist (client_id, item_id)
        values ('{$_SESSION['idd']}', '{$_GET['id']}')";

          mysqli_query($con,$query);
echo "<script>alert('This product has been added to your wish list.')</script>";
header ("location:wishlist.php");
}
else{
  echo "<script>alert('This product has already been added to your wish list.')</script>";
  header ("location:wishlist.php");

       } 
            }        //code executed and sent into cart.php without user seeing it
?>

