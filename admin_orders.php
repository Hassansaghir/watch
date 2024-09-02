<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <center><h2 class="mb-4">Admin Orders</h2></center>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="adminhome.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_users.php">Admin Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_orders.php">View Orders</a>
            </li>
        </ul>
        <div class="row mt-4">
            <?php
            require_once("admincon.php");
            if (!isset($_SESSION['email']))
            header("location:adminlogin.php");

            $query = "SELECT o.order_id, o.order_date, o.user_id, c.username AS username, c.phone, c.address, od.item_name, od.quantity, od.price
                      FROM orders o
                      INNER JOIN order_details od ON o.order_id = od.order_id
                      INNER JOIN clients c ON o.user_id = c.id
                      ORDER BY o.order_id ASC";

            $result = mysqli_query($con, $query);

            $current_order_id = null;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['order_id'] !== $current_order_id) {
                        // Nouveau groupe de commande
                        if ($current_order_id !== null) {
                            echo '<div class="order-total">Total: ' . number_format($total_price, 2) . '</div>';
                            echo '</div>'; // Fermer le précédent order-group
                        }
                        echo '<div class="col-md-12 order-group">';
                        echo '<div class="order-header">Order ID: ' . $row['order_id'] . '</div>';
                        echo '<div class="order-details">';
                        echo '<div>Order Date: ' . $row['order_date'] . '</div>';
                        echo '<div>User ID: ' . $row['user_id'] . '</div>';
                        echo '<div>Username: ' . $row['username'] . '</div>'; // Afficher le nom d'utilisateur
                        echo '<div>Phone: ' . $row['phone'] . '</div>'; // Afficher le numéro de téléphone
                        echo '<div>Address: ' . $row['address'] . '</div>'; // Afficher l'adresse
                        echo '</div>'; // Fermer .order-details
                        
                        // Initialiser le total du prix de la commande
                        $total_price = 0;
                        
                        $current_order_id = $row['order_id'];
                    }

                    // Détails de l'article pour chaque commande
                    echo '<div class="order-details">';
                    echo '<span class="item-name">' . $row['item_name'] . '</span>';
                    echo '<div>Quantity: ' . $row['quantity'] . '</div>';
                    echo '<div>Price: ' . $row['price'] . '</div>';
                    echo '</div>'; // Fermer .order-details
                    
                    // Ajouter le prix de l'article au total de la commande
                    $total_price += $row['price'];
                }
                
                // Afficher le total pour la dernière commande
                if ($current_order_id !== null) {
                    echo '<div class="order-total">Total: ' . number_format($total_price, 2) . '</div>';
                    echo '</div>'; // Fermer le dernier order-group
                }
            } else {
                echo "<p>No orders found.</p>";
            }

            mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>

<style>
    body {
        background-image: url('https://image.slidesdocs.com/responsive-images/docs/classical-european-border-poster-with-a-retro-vibe-page-border-background-word-template_ca66bc0c19__1131_1600.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    .container {
        max-width: 800px;
        margin: 50px auto;
    }
    .order-group {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .order-group .order-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #007bff;
    }
    .order-group .order-details {
        margin-bottom: 10px;
    }
    .order-group .item-name {
        font-weight: bold;
        color: #333;
    }
    .order-details {
        padding: 5px 0;
        border-bottom: 1px solid #eee;
    }
    .order-details:last-child {
        border-bottom: none;
    }
    .order-total {
        font-weight: bold;
        color: #333;
        margin-top: 10px;
    }
    .nav-pills {
        margin-bottom: 20px;
    }
</style>
