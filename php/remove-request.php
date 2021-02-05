<?php
require_once "../_functions.php";

db_connect();

$sql = "DELETE FROM friend_requests WHERE user_id = ? AND friend_id = ?";

$statement = $connection->prepare($sql);
$statement->bind_param('ii', intval($_GET['uid']), $_SESSION['user_id']);

if ($statement->execute())
    redirect_to("/profile.php");
else
    echo "Error: " . $connection->error;
