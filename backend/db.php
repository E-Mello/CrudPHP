<?php
$connection = new mysqli('localhost', 'root', 'abc123#4', 'clientes');
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
