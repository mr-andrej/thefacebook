<?php
require_once "../_functions.php";

db_connect();

$sql = "INSERT INTO friend_requests (user_id, friend_id) VALUES (?, ?)";

// If the redirection happened from the button to the left of a person, use that
// If the redirection happened from the email input, use the function to find the desired ID
// TODO: Show "you're already friends" if the person is already a friend
if (isset($_GET['email'])) {
    $targetID = $connection->query("SELECT `id` FROM users WHERE email='" . $_GET['email'] . "'")->fetch_object()->id;
} else
    $targetID = $_GET['uid'];

if (!isset($targetID)) // In case the user entered an email that doesn't exist in the DB
    redirect_to("/home.php");

$statement = $connection->prepare($sql);
$statement->bind_param('ii', $_SESSION['user_id'], $targetID);

if ($statement->execute())
    redirect_to("/home.php?request_sent=true");
else
    echo "Error: " . $connection->error;
