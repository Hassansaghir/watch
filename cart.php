<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container">
        <?php
        require_once("connection.php");
        require_once("nav.php");
        
        // Vérification de la session
        if (!isset($_SESSION['idd'])) {
            header("location:index.php");
            exit();
        }
        
        // Récupération de l'ID utilisateur
        $user_id = $_SESSION['idd'];
        
        // Traitement du bouton "Buy Now"
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnBuyNow'])) {
            $canBuy = true;
            $message = "";

            // Vérifier la disponibilité des articles
            $query = "SELECT c.*, i.name AS item_name, i.unit_price AS unit_price, i.stock AS item_stock
                      FROM carts c 
                      INNER JOIN item i ON c.item_id = i.id 
                      WHERE c.id ='$user_id'";
            $result = mysqli_query($con, $query);
            
            
            while($row = mysqli_fetch_array($result)){
                if ($row['quantity'] > $row['item_stock']) {
                    $canBuy = false;
                    $message .= "Le produit " . $row['item_name'] . " n'a pas assez de stock disponible.<br>";
                }
            }
            
            if ($canBuy) {
                // Insérer les détails de la commande dans la table orders
                $order_date = date('Y-m-d H:i:s'); // Date actuelle
                $insert_order_query = "INSERT INTO orders (order_date, user_id) VALUES ('$order_date', '$user_id')";
                mysqli_query($con, $insert_order_query);
                $order_id = mysqli_insert_id($con); // Récupérer l'ID de la commande insérée
                
                // Réinitialiser le résultat de la requête
                $result = mysqli_query($con, $query);
                
                // Insérer les détails de chaque article dans la table order_details et mettre à jour les stocks
                while($row = mysqli_fetch_array($result)){
                    $item_id = $row['item_id'];
                    $item_name = $row['item_name'];
                    $quantity = $row['quantity'];
                    $price = $row['unit_price'];
                    $total = $quantity * $price;
                    
                    $insert_order_details_query = "INSERT INTO order_details (order_id, item_id, item_name, quantity, price) 
                                                   VALUES ('$order_id', '$item_id', '$item_name', '$quantity', '$total')";
                    mysqli_query($con, $insert_order_details_query);
                    
                    // Mettre à jour la quantité de l'article dans la table item
                    $new_stock = $row['item_stock'] - $quantity;
                    $update_item_query = "UPDATE item SET stock = '$new_stock' WHERE id = '$item_id'";
                    mysqli_query($con, $update_item_query);
                }
                
                // Vider le panier après l'achat
                $delete_cart_query = "DELETE FROM carts WHERE id = '$user_id'";
                mysqli_query($con, $delete_cart_query);
                
                // Redirection vers une page de confirmation
              
            } else {
                echo "<div class='alert alert-danger' role='alert'>$message</div>";
            }
        }
        
        // Traitement du bouton "Delete"
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnDelete'])) {
            $item_id_to_delete = $_POST['dlt'];
            
            // Supprimer l'article du panier
            $delete_item_query = "DELETE FROM carts WHERE id = '$user_id' AND item_id = '$item_id_to_delete'";
            mysqli_query($con, $delete_item_query);
            
            // Rafraîchir la page pour refléter les changements
            header("Location: cart.php");
            exit();
        }
        ?>
        
        <!-- Formulaire de panier -->
        <form method="post">
            <table class='cart-table'>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                
                <?php
                // Récupération et affichage des articles dans le panier
                $query = "SELECT c.*, i.name AS item_name, i.unit_price AS unit_price, i.photo AS photo 
                          FROM carts c 
                          INNER JOIN item i ON c.item_id = i.id 
                          WHERE c.id ='$user_id'";
                $result = mysqli_query($con, $query);
                $total = 0;
                
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                            <td><img src='photo/{$row['photo']}'></td>
                            <td>{$row['item_name']}</td>
                            <td>{$row['unit_price']}$</td>
                            <td>{$row['quantity']}</td>
                            <td>
                                 <form method='post'>
                                    <input class='btn btn-primary' type='submit' name='btnDelete' value='Delete'>
                                    <input type='hidden' name='dlt' value='" . $row['item_id'] . "'>
                                </form>
                            </td>
                          </tr>";
                    
                    // Calcul du sous-total pour cet article
                    $subtotal = $row['unit_price'] * $row['quantity'];
                    
                    // Ajouter le sous-total au total général
                    $total += $subtotal;
                }
                ?>
                
                <tr>
                    <th colspan='4'>Total</th>
                    <th>$<?php echo $total; ?></th>
                </tr>
            </table>
            
            <!-- Bouton "Buy Now" -->
            <div class="checkout-btn">
                <input class="btn btn-success" type="submit" name="btnBuyNow" value="Buy Now">
            </div>
        </form>
    </div>
</body>
</html>
<style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .cart-table th, .cart-table td {
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
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }
        .checkout-btn {
            text-align: right;
            margin-bottom: 20px;
        }
        body {
            background-image: url('https://img.freepik.com/free-photo/shopping-cart-filled-with-coins-copy-space-background_23-2148305919.jpg?size=626&ext=jpg&ga=GA1.1.2113030492.1720224000&semt=ais_user');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .card {
            margin: 10px;
        }
</style>
