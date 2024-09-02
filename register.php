<?php
require_once("nav.php");
require_once("connection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['pswd'];
    $phone = $_POST['phone']; // Nouveau champ phone
    $address = $_POST['address']; // Nouveau champ address

    // Vérification si le nom d'utilisateur existe déjà
    $query = "SELECT * FROM clients WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Error!</strong> Username already taken.
        </div>";
    } else {
        $pwd = md5($pwd); // Hashage du mot de passe
        $query = "INSERT INTO clients (username, password, phone, address) VALUES ('$username', '$pwd', '$phone', '$address')";
        mysqli_query($con, $query);

        if (mysqli_affected_rows($con) == 0) {
            echo "<script>alert('Problem')</script>";
        } else {
            $_SESSION['idd'] = mysqli_insert_id($con); // Récupération de l'ID nouvellement inséré
            $_SESSION['username'] = $username;
            $_SESSION['phone'] = $phone; // Ajout du numéro de téléphone à la session
            $_SESSION['address'] = $address; // Ajout de l'adresse à la session

            header("Location: login.php"); // Redirection vers la page de connexion
        }
    }
} else {
    $username = $pwd = $phone = $address = ""; // Initialisation des variables
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container">
        <h2 class="form-title">Register Form</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username" class="form-label">Username: *</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required
                       value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label for="pwd" class="form-label">Password: *</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
            </div>
            <div class="form-group">
    <label for="phone" class="form-label">Phone Number:</label>
    <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
</div>
<div class="form-group">
    <label for="address" class="form-label">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
</div>

            <button type="submit" class="btn btn-primary">Create an account</button>
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
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
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