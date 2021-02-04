<?php
require_once "_functions.php";

db_connect();

$sql = "INSERT INTO friend_requests (user_id, friend_id) VALUES (?, ?)";

$statement = $connection->prepare($sql);
$statement->bind_param('ii', $_SESSION['user_id'], $_GET['uid']);

if ($statement->execute())
    redirect_to("/home.php?request_sent=true");
else
    echo "Error: " . $connection->error;
