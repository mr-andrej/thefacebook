<?php
require_once "../_functions.php";

db_connect();

$sql = "DELETE FROM friend_requests WHERE user_id = ?";

$statement = $connection->prepare($sql);
$statement->bindParam('i', $_GET['uid']);

if ($statement->execute())
    redirect_to("/profile.php?email=" . $_SESSION['user_email']);
else
    echo "Error: " . $connection->error;
