<?php
require_once '../session.php';
$_SESSION['username'] = null;
$_SESSION['useride'] = null;
unset($_SESSION);
session_destroy();
header('location:'.BASE_URL.'/frontend/login.php');