<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: sign_in.php");
?>