<?php
include "_header.php";
require_once "_functions.php";

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

if (!isset($id)) // In case the email isn't in the db
    redirect_to("/home.php");

?>
<!-- main -->
<main class="container">
    <div class="row">
        <div class="col-md-3">

            <!-- edit profile -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php if (!isset($_GET['email'])) { ?>

                        <h4>Update your profile</h4>
                        <form method="post" action="php/edit-profile.php">

                            <label>Status: </label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="status" placeholder="Status"
                                       value="<?php echo $status; ?>">
                            </div>

                            <label>Location: </label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="location" placeholder="Location"
                                       value="<?php echo $location; ?>">
                            </div>

                            <label>Relationship Status: </label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="relationship_status"
                                       placeholder="Relationship Status"
                                       value="<?php echo isset($relationship_status) ? $relationship_status : ' ';
                                       ?>">
                            </div>

                            <label>Profile Photo (URL): </label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="profile_image_url"
                                       placeholder="Relationship Status" value="<?php echo $profile_image_url; ?>">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Save">
                            </div>
                        </form>
                    <?php } ?>

                    <?php if (isset($_GET['email'])) { ?>

                        <h4>Send <?php echo $firstname . " " . $lastname; ?> a friend request</h4>
                        <form method="get" action="php/add-friend.php">
                            <input class="form-control" type="hidden" name="email" value="<?php echo $email;?>">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" name="post">Send</button>
                                </span>
                            </div>
                        </form>

                    <?php } ?>


                </div>
            </div>
        </div>

        <!-- ./edit profile -->
        <div class="col-md-6">
            <!-- user profile -->
            <div class="media">
                <div class="media-left">
                    <img src="<?php echo $profile_image_url; ?>" class="media-object"
                         style="width: auto; height: 128px;">
                </div>
                <div class="media-body">
                    <h2 class="media-heading"><?php echo $firstname . " " . $lastname; ?></h2>
                    <p>Status: <?php echo $status; ?>
                        <br> Relationship Status: <?php echo $relationship_status; ?>
                        <br> Location: <?php echo $location; ?>

                    </p>

                </div>
            </div>
            <!-- user profile -->

            <hr>

            <!-- timeline -->
            <div>
                <form method="post" action="php/create-post.php?from=profile">
                    <div class="input-group">
                        <input class="form-control" type="text" name="content" placeholder="Make a post…">
                        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" name="post">Post</button>
    </span>
                    </div>
                </form>
                <br>
                <!-- post -->
                <?php
                $sql = "SELECT * FROM posts WHERE posts.user_id = {$id} ORDER BY created_at DESC";

                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    while ($post = $result->fetch_assoc()) {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p style="width: auto; height-max: 400px;"><?php echo $post['content']; ?></p>
                            </div>
                            <div class="panel-footer">
                                <span>Posted <?php echo $post['created_at']; ?> by <?php echo $post['firstname']; ?></span>
                                <span class="pull-right"><a class="text-danger"
                                                            href="php/delete-post.php?id=<?php echo $post['id']; ?>&from=profile">[delete]</a></span>
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
            <!-- ./timeline -->
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
                                <a href="profile.php?email=<?php echo $fr_user['email']; ?>"><?php echo $fr_user['firstname'] . " " . $fr_user['lastname']; ?></a>
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
