<?php

include_once '../login/sessionStart.php';
unset ($SESSION['username']);
session_destroy();

$url =  "../login/Login.html";
header("Location: {$url}");

?>