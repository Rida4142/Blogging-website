<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("conn.php");
include("functions.php"); // Ensure it includes recordUserActivity()

// Fetch blog details
if (isset($_GET['bid'])) {
    $bid = mysqli_real_escape_string($con, $_GET['bid']);
    $query = "SELECT U.uname, B.bid, B.uid, B.btitle, B.bcontent, B.bcreated_at
              FROM blog AS B
              JOIN users AS U
              ON B.uid = U.uid
              WHERE B.bid = '$bid'
              LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        $title = $row['btitle'];
        $content = $row['bcontent'];
        $meta = [
            'created_at' => $row['bcreated_at'],
            'name' => $row['uname'],
        ];

        // Record the user's activity (Blog View)
        if (isset($_SESSION['auth_user']['wid'])) {
            $uid = $_SESSION['auth_user']['wid'];
            recordUserActivity($con, $uid, 'BLOG_VIEW', $bid, "Viewed blog titled '$title'");
        }
    } else {
        echo "Invalid blog ID.";
        exit;
    }
} else {
    echo "No blog ID provided.";
    exit;
}

include("includes/blogheader.php");
include("includes/navbar.php");
?>

<div class="blog-page">
    <div class="blog-card">
        <?php 
        include("blog/blog_title.php"); // Display blog title
        ?>
        <div class="content"><?php echo html_entity_decode($content); ?></div>
        <?php 
        include("blog/comments_disp.php"); // Display comments section
        ?>
    </div>
</div>
