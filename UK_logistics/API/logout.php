<?php
    session_start();
    session_destroy();
    header("Location: http://localhost/UK_logistics/login.php");
?>