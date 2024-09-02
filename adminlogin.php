
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <title>Document</title>
</head>
<body>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://img.lovepik.com/photo/48017/0904.jpg_wh860.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="" method="post">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Admin Login</p>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0"></p>
          </div>

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter email address" />
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" />
             </div>

          <div class="text-center text-lg-start mt-4 pt-2">
           <button type="submit" name="login" style="background-color: wheat; margin-left:7em;width:200px; height:40px;">login</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
<?php 
require_once("admincon.php");
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $username = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM adminlogin WHERE (username='$username' OR email='$email') AND password='$password'";
    echo "<pre>$query</pre>";

    $result = mysqli_query($con, $query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION['adminID'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        header("Location: adminhome.php");
        exit();
    } else {
        echo "<script>alert('Invalid Email or Password')</script>";
    }
}
?>
</body>
</html>
<style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
</style>