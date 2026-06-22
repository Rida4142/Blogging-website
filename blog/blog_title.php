<?php 
include("conn.php");
?>

<div class="blog-header">
            <h3><?php echo htmlspecialchars($title); ?></h3>
            <div>
                <!-- Like Button -->
                <form action="like.php" method="POST">
                    <input type="hidden" name="blog_id" value="<?php echo $bid; ?>">
                    <?php
                    $user_id = $_SESSION['auth_user']['wid'];
                    $query = "SELECT * FROM blog_like WHERE uid = '$user_id' AND bid = '$bid' LIMIT 1";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) { ?>
                        <div class="like-div">
                            <button type="submit" class="thumbs-up-button" style="background-color: olive;">
                                <span class="material-icons" style="color: white;">thumb_up</span>
                            </button>
                        </div>
                    <?php } else { ?>
                        <div class="like-div">
                            <button type="submit" class="thumbs-up-button">
                                <span class="material-icons">thumb_up</span>
                            </button>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>