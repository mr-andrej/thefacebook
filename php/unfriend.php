<?php

require_once "../_functions.php";

db_connect();

$sql = "DELETE FROM friends WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)"; // Honestly I can't decide whether a PDO connection is better, I like this more

$statement = $connection->prepare($sql);
$statement->bind_param('iiii', $_GET['uid'], $_SESSION['user_id'], $_SESSION['user_id'], $_GET['uid']);

if ($statement->execute())
    redirect_to("/profile.php?email=" . $_SESSION['user_email']);
 else
    echo "Error: " . $connection->error;
