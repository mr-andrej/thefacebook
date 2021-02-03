<?php
require_once "../_functions.php";

db_connect();

$sql = "INSERT INTO users (email, firstname, lastname, password, location) values (?, ?, ?, ?, ?)";

$statement = $connection->prepare($sql);

$statement->bind_param("sssss", $_POST["email"], $_POST["firstname"], $_POST["lastname"],
    password_hash($_POST['password'], PASSWORD_DEFAULT),
    $_POST['location']);

if ($statement->execute()) {
    redirect_to("/index.php?registered=true");
} else {
    echo "Error: " . $connection->error;
}
