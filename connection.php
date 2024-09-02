<?php
session_save_path("session");
session_start();
$con = mysqli_connect("localhost","root","","php_dev")
        or die("Error");
?>