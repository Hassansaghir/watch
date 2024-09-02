<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Page</title>
    <style>
         body {
            background-image: url('https://cdn.prod.website-files.com/64949e4863d96e26a1da8386/64b9451865a683fd39bccfa1_5f6e93d250a6d04f4eae9f02_Backgrounds-WFU-thumbnail-(size).jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .card {
            margin: 10px;
        }
         
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: row;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        .card img {
            width: 50%;
            object-fit: cover;
        }
        .card-content {
            padding: 20px;
            flex: 1;
        }
        .card-content h1 {
            margin-top: 0;
            font-size: 24px;
        }
        .price {
            color: grey;
            font-size: 22px;
        }
        .card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .card button:hover {
            opacity: 0.7;
        }
        .container {
            margin-top: 20px;
        }
        .alert {
            border: 1px solid #ffc107;
            border-radius: 5px;
            padding: 15px;
            background-color: #fff3cd;
            color: #856404;
        }
        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.2em;
            color: #856404;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
session_start();
require_once("nav.php");
if(!isset($_GET['id'])) {
    header("location:index.php");
}
require_once("connection.php");
$query = "select * from item where id = {$_GET['id']}";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    echo "<div class='card'>
        <center>    <img src='photo/{$row['photo']}' alt='{$row['name']}'></center>
            <div class='card-content'>
                <h1>{$row['name']}</h1>
                <p class='price'>{$row['unit_price']}$</p>
                <p>{$row['description']}</p>";
                if(isset($_SESSION['username'])){
                echo "<p><a href='addtocart.php?id={$row['id']}'><button>Add to Cart</button></a></p>
                <p><a href='addtowhishlist.php?id={$row['id']}'><button>Add to Wishlist</button></a></p>";
                }
                echo "
                
            </div>
          </div>";
} else {
    echo "<div class='container mt-3'>
            <div class='alert alert-warning alert-dismissible'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Warning!</strong> Item not found.
              </div>
          </div>";
}
?>
</body>
</html>
