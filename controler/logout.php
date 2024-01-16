<?php
session_start();
$_SESSION = array();
session_unset();
session_destroy();
header("Cache-Control:no-cache");
header('location:index.php');
