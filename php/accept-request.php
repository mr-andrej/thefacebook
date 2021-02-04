<?php

require_once "../_functions.php";

db_connect();

$sql = "INSERT INTO friends (user_id, friend_id) VALUES (?, ?), (?, ?)";

$statement = $connection->prepare($sql);
$statement->bind_param('iiii', $_SESSION['user_id'], $_GET['uid'],
    $_GET['uid'], $_SESSION['user_id']);

if ($statement->execute())
    redirect_to("/php/remove-request.php?uid=" . $_GET['uid']);
else
    echo "Error: " . $connection->error;
