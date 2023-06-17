<?php
require_once '../session.php';

// check if user is logged in
if (isset($_SESSION['username'])) {
    // get client ID to delete from GET request
    $id = $_GET['id'];

    // prepare and execute MySQL statement to delete client by ID
    require_once 'db.php';
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    if (!$connection) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    $sql = $connection->prepare("DELETE FROM usuarios WHERE id = ?");
    if (!$sql) {
        die('Prepare failed: ' . $connection->error);
    }
    $sql->bind_param('i', $id);
    if (!$sql->execute()) {
        die('Execute failed: ' . $sql->error);
    }

    // send success response
    http_response_code(200);
    echo json_encode(array('message' => 'Client deleted successfully'));
    die();
}