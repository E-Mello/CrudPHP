<?php
require_once '../session.php';

// check if user is logged in
if (isset($_SESSION['username'])) {
    // get new client data from POST request
    $data = json_decode(file_get_contents('php://input'));
    
    // validate new client data to prevent SQL injection
    // TODO: Implement validation
    
    // prepare and execute MySQL statement to insert or update client data
    require_once 'db.php';
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    
    if (!$connection) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    
    if ($data->id) {
        // Update existing client
        $sql = $connection->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
        if (!$sql) {
            die('Prepare failed: ' . $connection->error);
        }
        $sql->bind_param('sssi', $data->nome, $data->email, $data->senha, $data->id);
    } else {
        // Insert new client
        $sql = $connection->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        if (!$sql) {
            die('Prepare failed: ' . $connection->error);
        }
        $sql->bind_param('sss', $data->nome, $data->email, $data->senha);
    }
    
    if (!$sql->execute()) {
        die('Execute failed: ' . $sql->error);
    }

    // get the inserted/updated ID
    $id = $data->id ? $data->id : $sql->insert_id;

    // send response with new/updated client ID
    header('Content-Type: application/json');
    echo json_encode(array('id' => $id));
}