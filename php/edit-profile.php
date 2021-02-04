<?php

require_once "../_functions.php";

db_connect();

$sql = "UPDATE users SET status = ?, location = ?, relationship_status = ? WHERE id = ?";

$statement = $connection->prepare($sql);

$statement->bind_param('sssi', $_POST['status'], $_POST['location'], $_POST['relationship_status'], $_SESSION['user_id']);

if ($statement->execute())
    redirect_to("/profile.php?username={$_SESSION['user_username']}");
 else
    echo "Error: " . $connection->error;

