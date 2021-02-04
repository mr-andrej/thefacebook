<?php
require_once "../_functions.php";

db_connect();

$sql = "INSERT INTO friend_requests (user_id, friend_id) VALUES (?, ?)";

// If the redirection happened from the button to the left of a person, use that
// If the redirection happened from the email input, use the function to find the desired ID
// TODO: Show "you're already friends" if the person is already a friend

$targetID = (isset($_GET['uid'])) ? $_GET['uid'] : 1;


$statement = $connection->prepare($sql);
$statement->bind_param('ii', $_SESSION['user_id'], $targetID);

if ($statement->execute())
    redirect_to("/home.php?request_sent=true");
else
    echo "Error: " . $connection->error;
