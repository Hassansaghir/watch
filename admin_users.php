<?php
require_once("admincon.php");
if (!isset($_SESSION['email']))
    header("location:adminlogin.php");

$query = "SELECT * FROM clients";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $users = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <center><h2 class="mb-4">Admin Users</h2></center>
        <ul>
            <li><a class="active" href="adminhome.php">Home</a></li>
            <li><a href="admin_orders.php">View Orders</a></li>
            <li><a href="adminlogout.php">Logout</a></li>
        </ul>
        <div class="row mt-4">
            <?php foreach ($users as $user): ?>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $user['username']; ?></h5>
                            <p class="card-text">Phone: <?php echo $user['phone']; ?></p>
                            <p class="card-text">Address: <?php echo $user['address']; ?></p>
                            <a href="#" class="btn btn-primary">View Details</a> <!-- Lien pour voir les détails, à implémenter -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<style>
     body {
            background-image: url('https://t4.ftcdn.net/jpg/01/05/72/61/360_F_105726195_r0MpL0Noxp2NeMh3RsRwCskbeL7ensjV.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    .container {
        max-width: 800px;
        margin: 50px auto;
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
