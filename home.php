<?php include "_header.php" ?>
<?php require_once "_functions.php";

check_auth();
db_connect();

if (isset($_GET['email']))
    $sql = "SELECT id, email, firstname, lastname, status, relationship_status, profile_image_url, location FROM users WHERE email = ?";
else
    $sql = "SELECT id, email, firstname, lastname, status, relationship_status, profile_image_url, location FROM users WHERE id = ?";

$statement = $connection->prepare($sql);

if (isset($_GET['email']))
    $statement->bind_param('s', $_GET['email']);
else
    $statement->bind_param('s', $_SESSION['user_id']);

$statement->execute();
$statement->store_result();
$statement->bind_result($id, $email, $firstname, $lastname, $status, $relationship_status, $profile_image_url, $location);
$statement->fetch();
?>
<!-- main -->
<main class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- profile brief -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4><?php echo $firstname . " " . $lastname; ?></h4>
                    <p><i><?php echo $status; ?></i></p>
                    <div style="text-align: right">
                        <small><?php echo $location; ?></small>
                    </div>
                </div>
            </div>
            <!-- ./profile brief -->


        </div>
        <div class="col-md-6">
            <!-- post form -->
            <form method="post" action="php/create-post.php">
                <div class="input-group">
                    <input class="form-control" type="text" name="content" placeholder="Make a post…">
                    <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" name="post">Post</button>
    </span>
                </div>
            </form>
            <hr>
            <!-- ./post form -->

            <!-- feed -->
            <div>
                <!-- post -->
                <?php
                $sql = "SELECT * FROM posts ORDER BY created_at DESC";

                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    while ($post = $result->fetch_assoc()) {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p><?php echo $post['content']; ?></p>
                            </div>
                            <div class="panel-footer">
                                <span>Posted <?php echo $post['created_at']; ?> by <?php echo $post['firstname']; ?></span>
                                <span class="pull-right"><a class="text-danger"
                                                            href="php/delete-post.php?id=<?php echo $post['id']; ?>">[delete]</a></span>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p class="text-center">No posts yet!</p>
                    <?php
                }
                ?>
                <!-- ./post -->
            </div>
            <!-- ./feed -->
        </div>
        <div class="col-md-3">
            <!-- add friend -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Send friend request</h4>
                    <form method="get" action="php/add-friend.php">
                        <div class="input-group">
                            <input class="form-control" type="text" name="email" placeholder="Enter e-mail">
                            <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ./add friend -->

            <!-- friends -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Friends</h4>
                    <?php
                    $sql = "SELECT * FROM friends WHERE friend_id = {$_SESSION['user_id']}";

                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <ul><?php
                        while ($friend = $result->fetch_assoc()) {
                            ?>
                            <li>
                                <?php
                                $u_sql = "SELECT * FROM users WHERE id = {$friend['user_id']} LIMIT 1";
                                $u_result = $connection->query($u_sql);
                                $fr_user = $u_result->fetch_assoc();
                                ?>
                                <a href="profile.php?email=<?php echo $fr_user['email']; ?>"><?php echo $fr_user['firstname'] . " " . $fr_user['lastname']; ?></a>
                                <a class="text-danger" href="php/remove-request.php?uid=<?php echo $fr_user['id']; ?>">[unfriend]</a>
                            </li>
                            <?php
                        } ?></ul><?php
                    } else {
                        ?>
                        <p class="text-center">No pending friend requests!</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!-- ./friends -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Pending Friend Requests</h4>
                    <?php
                    $sql = "SELECT * FROM friend_requests WHERE friend_id = {$_SESSION['user_id']}";

                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <ul><?php
                        while ($friend = $result->fetch_assoc()) {
                            ?>
                            <li>
                                <?php
                                $u_sql = "SELECT * FROM users WHERE id = {$friend['user_id']} LIMIT 1";
                                $u_result = $connection->query($u_sql);
                                $fr_user = $u_result->fetch_assoc();
                                ?>
                                <a href="profile.php?email=<?php echo $fr_user['email']; ?>"><?php echo $fr_user['email']; ?></a>
                                <a class="text-success" href="php/accept-request.php?uid=<?php echo $fr_user['id']; ?>">[accept]</a>
                                <a class="text-danger" href="php/remove-request.php?uid=<?php echo $fr_user['id']; ?>">[decline]</a>
                            </li>
                            <?php
                        } ?></ul><?php
                    } else {
                        ?>
                        <p class="text-center">No pending friend requests!</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- ./main -->
<?php include "_footer.php" ?>


<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
