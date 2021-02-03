<?php
require_once "../_functions.php";

db_connect();

$sql = "DELETE FROM posts WHERE id = ?";

$statement = $connection->prepare($sql);

$statement->bind_param('i', $_GET['id']);

if ($statement->execute()) {
    redirect_to("/home.php");
} else {
    echo "Error: " . $connection->error;
}
$connection->close();
