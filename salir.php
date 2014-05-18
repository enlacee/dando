<?php
session_start();



$_SESSION["email"] = NULL;
unset($_SESSION["email"]);


header("Location: index.php")
?>