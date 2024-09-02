<?php
    require_once("nav.php");
    require_once("connection.php");
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $pswd = $_POST['pswd'];
        $pswd = md5($pswd);

        $query = "SELECT * FROM clients WHERE username = '$username' AND password = '$pswd' ";

        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result)==1){
            $_SESSION['username']=$username;
            $_SESSION['id'] = mysqli_insert_id($con);
            $row=mysqli_fetch_assoc($result);
            $_SESSION['idd'] =$row['id'];
            header("Location: index.php");
        }
        else{
            echo "<script> alert('Invalid username or password'); </script>";
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container">
        <h2 class="form-title">Login Form</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username" class="form-label">Username: *</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="form-group">
                <label for="pwd" class="form-label">Password: *</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
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
            max-width: 400px;
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
