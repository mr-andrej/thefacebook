<?php
require_once "../_functions.php";

db_connect();

$sql = "INSERT INTO posts (content, user_id, firstname) VALUES (?, ?, ?)";

$statement = $connection->prepare($sql);

$statement->bind_param('sis', $_POST['content'], $_SESSION['user_id'], $_SESSION['firstname']);

if ($statement->execute()) {
    if ($_GET['from'] === 'profile')
        redirect_to("/profile.php");
    else
        redirect_to("/home.php");
} else {
    echo "Error: " . $connection->error;
}
