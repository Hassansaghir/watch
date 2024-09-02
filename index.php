<?php
    require_once("connection.php");
    require_once("nav.php");
    $sql = "select * from item";
    if(isset($_GET['id']))
    $sql.= " where category_id = {$_GET['id']}";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 0)
    echo "<script> alert('No item found'); </script>";
  else {
    while ($row = mysqli_fetch_array($result)) {
        echo 
        "<div class='card' style='width:300px; float:left; margin: 10px; height: 400px;'>
                <div class='d-flex justify-content-center' style='height: 220px;'>
                    <img class='card-img-top' src='photo/{$row['photo']}' alt='Card image' style='max-width: 100%; max-height: 100%;'>
                </div>
                <div class='card-body'>
                    <h4 class='card-title'>{$row['name']}</h4>
                    <p class='card-text' style='margin-bottom: 50px;'> {$row['unit_price']}$</p>
                   <center> <a href='item.php?id={$row['id']}' class='btn btn-primary'>See More...</a> <center>
                </div>
              </div>";
    }
  }    
  ?>
</div>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://i.pinimg.com/564x/cc/dc/52/ccdc521feff0200a788df87df6c7e6cc.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .card {
            margin: 10px;
        }
    </style>
</head>
</body>

</html>
