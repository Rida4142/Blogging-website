<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

include("conn.php");
include("functions.php"); // Ensure it includes recordUserActivity()

// Check if the user is logged in
if (!isset($_SESSION['auth_user']['wid'])) {
    echo "You must be logged in to like a blog.";
    exit();
}

$uid = $_SESSION['auth_user']['wid']; // Get the logged-in user ID

if (isset($_POST['blog_id'])) {
    $blog_id = mysqli_real_escape_string($con, $_POST['blog_id']);

    // Check if the user has already liked the blog
    $check_query = "SELECT * FROM blog_like WHERE bid = '$blog_id' AND uid = '$uid'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Unlike the blog
        $delete_query = "DELETE FROM blog_like WHERE bid = '$blog_id' AND uid = '$uid'";
        if (mysqli_query($con, $delete_query)) {
            // Record the unlike activity
            recordUserActivity($con, $uid, 'BLOG_UNLIKE', $blog_id, "Removed like on blog ID $blog_id");

            // Redirect to the blog page
            header("Location: blog.php?bid=$blog_id");
            exit();  
        } else {
            echo "Error removing like: " . mysqli_error($con);
        }
    } else {
        // Like the blog
        $insert_query = "INSERT INTO blog_like (bid, uid) VALUES ('$blog_id', '$uid')";
        if (mysqli_query($con, $insert_query)) {
            // Record the like activity
            recordUserActivity($con, $uid, 'BLOG_LIKE', $blog_id, "Liked blog ID $blog_id");

            // Redirect to the blog page
            header("Location: blog.php?bid=$blog_id");
            exit(); 
        } else {
            echo "Error adding like: " . mysqli_error($con);
        }
    }
} else {
    echo "Invalid request. Blog ID not provided.";
    exit();
}
?>
