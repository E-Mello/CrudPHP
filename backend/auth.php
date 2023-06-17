<?php
require_once '../session.php';

if (isset($_POST['email'], $_POST['senha'])) {
    $username = $_POST['email'];
    $password = $_POST['senha'];

    if (login($username, $password) == true) {
        // Login success
        header('Location: '.BASE_URL.'/frontend/app.php');
        exit();
    } else {
        // Login failed
        header('Location: '.BASE_URL.'/frontend/login.php');
        exit();
    }
} else {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}

function login($username, $password){

    require_once(BASE_PATH.'/backend/db.php');
    $sql = "SELECT * FROM usuarios WHERE email = '$username' AND senha = '$password'";
    $result = $connection->query($sql);
    if($result->num_rows == 1){
        $obj = $result->fetch_object();
        $_SESSION['userid'] = $obj->id;
        $_SESSION['username'] = $obj->nome;
        return true;
    } else {
        return false;
    }
}