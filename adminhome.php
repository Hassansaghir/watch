<?php
require_once("admincon.php");
if (!isset($_SESSION['email']))
    header("location:adminlogin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    



<ul>
  <li><a class="active" href="adminhome.php">Home</a></li>
  <li><a class="" href="index.php" target="_blank">Website Home</a></li>
  <a href="admin_orders.php" class="btn btn-primary">View Orders</a>
  <li><a href="admin_users.php">Admin Users</a></li>
  <li><a href="adminlogout.php">Logout</a></li>
  

</ul>
    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $desc = $_POST['desc'];
        $category = $_POST['category'];

        $photo =$_FILES['photo']['name'];
        $tmp =$_FILES['photo']['tmp_name'];
        $path ="photo/".$photo;
        move_uploaded_file($tmp, $path);
        $query = "insert into item(name, unit_price, stock,photo,category_id, description) values('$name', '$price', '$stock','$photo', '$category', '$desc')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<script>alert('Item Added')</script>";
            header("location:adminhome.php");
        } else {
            echo "<script>alert('Item Not Added')</script>";
        }
    }

    ?>
    <h1>Add New Item</h1>
    <form class="cf" method="POST" enctype="multipart/form-data">
        <div class="half left cf">
            <br><input type="file" name="photo" id="input-file">
            <input type="text" id="input-name" placeholder="Name" name="name">


            <input type="text" id="input-email" placeholder="Price" name="price">

            <input type="text" id="input-subject" placeholder="Stock" name="stock">
            <textarea name="desc" id="" rows="30"></textarea>
            <?php
            $query = "select * from categories";
            $result2 = mysqli_query($con, $query);
            echo "<select name='category'> ";
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "<option name='category' value='{$row2['id']}'>{$row2['category_name']}</option>";
            }
            echo ' </select>';
            ?>

        </div>
        <input type="submit" name="submit" value="insert" id="input-submit">
    </form>
    <?php

    echo "<form method='post'>";

    //display content

    echo "<table class='cart-table'>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Brand</th>
                    <th colspan=2>Action</th>
                </tr>";

    $query = "select * from item";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>
                        <td><img src='photo/{$row['photo']}'></td>
                        <td>{$row['name']}</td>
                        <td>{$row['unit_price']}$</td>
                        <td>{$row['stock']}</td>
                        <td>{$row['category_id']}</td>

                        <td>
                        <a href='adminupdate.php?id={$row['id']}'><button'>Update</button></a><br>
                        </td>
                        </tr>";
    }
    ?>
    </table>
    </form>
    </div>
</body>

</html>
<style>
    .container {
        max-width: 800px;
        margin: 50px auto;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .cart-table th,
    .cart-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .cart-table th {
        background-color: #007bff;
        color: #fff;
    }

    .cart-table img {
        max-width: 80px;
        max-height: 80px;
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .checkout-btn {
        text-align: right;
    }


    @import "compass/css3";

    @import url(https://fonts.googleapis.com/css?family=Merriweather);



    html,
    body {
        background: #f1f1f1;
        font-family: 'Merriweather', sans-serif;
        padding: 1em;
    }

    h1 {
        text-align: center;
        color: #a8a8a8;
    }

    form {
        max-width: 600px;
        text-align: center;
        margin: 20px auto;

        input,
        textarea {
            border: 0;
            outline: 0;
            padding: 1em;

            display: block;
            width: 100%;
            margin-top: 1em;
            font-family: 'Merriweather', sans-serif;

            resize: none;


        }

        #input-submit {
            color: white;
            background: greenyellow;
            cursor: pointer;


        }

        textarea {
            height: 126px;
        }
    }


    .half {
        float: left;
        width: 48%;
        margin-bottom: 1em;
    }

    .right {
        width: 50%;
    }

    .left {
        margin-right: 2%;
    }


    @media (max-width: 480px) {
        .half {
            width: 100%;
            float: none;
            margin-bottom: 0;
        }
    }


    /* Clearfix */
    .cf:before,
    .cf:after {
        content: " ";
        /* 1 */
        display: table;
        /* 2 */
    }

    .cf:after {
        clear: both;
    }


    ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
  top: 0;
  left: 0;
  width: 100px;
  background-color: #f1f1f1;
  height: 100%; /* Full height */
  position: fixed; /* Make it stick, even on scroll */
  overflow: auto; /* Enable scrolling if the sidenav has too much content */
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li {
  text-align: center;
  border-bottom: 1px solid #555;
}

li:last-child {
  border-bottom: none;
}

li a.active {
  background-color: #04AA6D;
  color: white;
}

li a:hover:not(.active) {
  background-color: #555;
  color: white;
}
</style>