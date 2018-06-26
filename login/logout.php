<?php

session_start();
unset ($SESSION['username']);
session_destroy();

$url =  "../login/Login.html";
header("Location: {$url}");

?>