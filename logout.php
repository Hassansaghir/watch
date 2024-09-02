<?php
    require_once("connection.php");
    $_SESSION = array(); //emptying the session
    session_destroy();
    header("location: index.php");
?>