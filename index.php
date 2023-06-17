<?php
require_once 'session.php';

if (!$_SESSION['username'])
    header("location:" . BASE_URL . "/frontend/login.php");
