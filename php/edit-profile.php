<?php

require_once "../_functions.php";

db_connect();

$sql = "UPDATE users SET status = ?, location = ?, relationship_status = ?, profile_image_url = ? WHERE id = ?";

$statement = $connection->prepare($sql);

$statement->bind_param('ssssi', $_POST['status'], $_POST['location'], $_POST['relationship_status'], $_POST['profile_image_url'], $_SESSION['user_id']);

if ($statement->execute())
    redirect_to("/profile.php?");
else
    echo "Error: " . $connection->error;

