<?php 
require_once("admincon.php");
if(!isset($_GET['id'])){
    header('Location: adminhome.php');

}
$sid = session_id();
if(isset($_POST['btnDelete'])){
    $sql = "DELETE FROM item WHERE id = {$_GET['id']}";
    $result = mysqli_query($con, $sql);
    header('Location: adminhome.php');
    exit();


}
   
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php 
 $id = $_GET['id'];
 $sql = "SELECT * FROM item WHERE id = $id";
 $result = mysqli_query($con, $sql);
 $row = mysqli_fetch_array($result);
 ?>

<h1>Update Item</h1>
<form class="cf" method="POST" enctype="multipart/form-data">
  <div class="half left cf">
    <?php echo "<img src='photo/{$row['photo']}'"; ?>
  
    <br><input type="file" name="photo" id="input-file">
    <input type="text" id="input-name" placeholder="Name" name="name" value="<?php  echo $row['name']; ?>">


    <input type="text" id="input-email" placeholder="Price" name="price" value="<?php  echo $row['unit_price']; ?>">

    <input type="text" id="input-subject" placeholder="Stock" name="stock" value="<?php echo $row['stock']; ?>">
    <textarea name="desc" id="" rows="30" ><?php echo $row['description']; ?></textarea>
    <?php 
    $query ="select * from categories";
    $result2 = mysqli_query($con, $query);
   echo "<select name='category_id'> "; 
    while($row2 = mysqli_fetch_array($result2)){
        if($row2['id'] == $row['category_id']){
            echo "<option name='category' value='{$row2['id']}' selected>{$row2['category_name']}</option>";
        }else{
        echo "<option name='category' value='{$row2['id']}'>{$row2['category_name']}</option>";
    }
}
    ?>
    </select>
  </div>
  <input type="submit" name="Update" value="Update" id="input-submit">
  <input type="submit" name="btnDelete" value="Delete" id="input-delete" style="cursor: pointer;">
  
</form>
<?php 
    if(isset($_POST['Update'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $desc = $_POST['desc'];
        if (isset($_POST['category_id'])) {
            $category = $_POST['category_id'];
        } else {
            die('L\'ID de la catégorie est manquant');
        }
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            die('L\'ID de l\'article est manquant');
        }
        if($_FILES['photo']['size']>0){
            $uploadesDirectory ="photo/";
            $uploadfile=$uploadesDirectory .$_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
            $photo = $_FILES['photo']['name'];
        }else{
            $photo =$row['photo'];
        }
        $sql = "UPDATE item SET name ='$name', unit_price = '$price', photo = '$photo', stock = '$stock', description = '$desc', category_id = '$category' WHERE id = $id";
        $result = mysqli_query($con, $sql);
        if($result){
            header('Location: adminhome.php');
        }else{
            echo mysqli_error($con);
        }
    }
?>
</body>
</html>
<style>
    @import "compass/css3";

@import url(https://fonts.googleapis.com/css?family=Merriweather);



html, body {
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
  
  input, textarea {
     border:0; outline:0;
     padding: 1em;
   
     display: block;
     width: 100%;
     margin-top: 1em;
     font-family: 'Merriweather', sans-serif;
  
     resize: none;
    
 
  }
  
  #input-submit {
     color: white; 
     background:red;
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

.right { width: 50%; }

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
    content: " "; /* 1 */
    display: table; /* 2 */
}

.cf:after {
    clear: both;
}
</style>