<?php
session_save_path("session");
session_start();
$con = mysqli_connect("localhost","root","","watsh")
        or die("Error");
?>