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
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categories</a>
  <ul class="dropdown-menu">
  <li class="nav-item">
        <a class="nav-link" href="checkout.php">Checkout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.php">Order List</a>
      </li>
    <?php
        require_once("connection.php");

        $query = "select * from categories order by category_name"; 
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)){
            //we take only one because it is in a loop
            echo "<li><a class='dropdown-item' href='index.php?id={$row['id']}'>{$row['category_name']}</a></li>";   
        }
    ?>
      </ul>
    </li>
            <?php
              if(isset($_SESSION['username'])){
                echo "<li class='nav-item'>
                <a class='nav-link' href='wishlist.php'>Wishlist</a>
              </li>";
              echo "<li class='nav-item'>
              <a class='nav-link' href='cart.php'>Cart</a>
            </li>";
              }
            ?>
          </ul>
    
          <?php 
          if(isset($_GET['id']))
          echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
        ?>
        
      </form>
          <ul class='navbar-nav'>
          <?php
          if(isset($_SESSION['id'])){
          echo "
                  <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='logout.php' role='button' data-bs-toggle='dropdown'>
          {$_SESSION['username']} </a>
          <ul class='dropdown-menu'>
         
            <li><a class='dropdown-item' href='logout.php'>Logout</a></li>
          </ul>
        </li>
          </ul>";
          }
          else { //eza ma ken connected
            echo "<li class='nav-item'>
            <a class='nav-link' href='register.php'>Register</a>
          </li>

          <li class='nav-item'>
            <a class='nav-link' href='login.php'>Login</a>
          </li>";
           }
          ?>
          </ul>
        </div>
      </div>
</nav>
<div class="container">
