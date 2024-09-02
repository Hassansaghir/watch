<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    

<?php
    require_once("connection.php");
    //eza badna n3addil men 3addil bi mahal wahad laan aana kaza page
    require_once("nav.php");

    if(!isset($_SESSION['id']))
    header("location: login.php");

  if(isset($_POST['btnDelete'])){
    $itemId = $_POST['item_id'];
    $sql = "DELETE FROM whishlist WHERE item_id ='$itemId'";
    $result = mysqli_query($con, $sql);
    header('Location: wishlist.php');
} 


    $sql = "select * from item,whishlist
    where item.id = whishlist.item_id and
     client_id = {$_SESSION['idd']}";
    
   
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 0){
    echo "<script> alert('No items found'); </script>";}
  else {
    while ($row = mysqli_fetch_array($result)) {
      echo "<div class='card' style='width:300px; float:left; margin: 10px; height: 400px;'>
              <div class='d-flex justify-content-center' style='height: 220px;'>
                  <img class='card-img-top' src='photo/{$row['photo']}' alt='Card image' style='max-width: 100%; max-height: 100%;'>
              </div>
              <div class='card-body'>
                  <h4 class='card-title'>{$row['name']}</h4>
                  <p class='card-text' style='margin-bottom: 50px;'> {$row['unit_price']}$</p>
                  <form method='POST' action='wishlist.php'>
                    <input type='hidden' name='item_id' value='{$row['item_id']}'>
                    <input class='btn btn-primary' type='submit' name='btnDelete' value='Delete'>
                </form>
              </div>
            </div>";
    }
  }
  ?>
</div>
</body>
</html>
<style>
   body {
            background-image: url('https://img.freepik.com/free-photo/shopping-cart-filled-with-coins-copy-space-background_23-2148305919.jpg?size=626&ext=jpg&ga=GA1.1.2113030492.1720224000&semt=ais_user');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .card {
            margin: 100px;
        }
  
</style>
   