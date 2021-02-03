<?php
require_once "../_functions.php";

db_connect();

$sql = "INSERT INTO posts (content, user_id) VALUES (?, ?)";

$statement = $connection->prepare($sql);

$statement->bind_param('si', $_POST['content'], $_SESSION['user_id']);

if ($statement->execute()) {
    redirect_to("/home.php");
} else {
    echo "Error: " . $connection->error;
}
$connection->close();
