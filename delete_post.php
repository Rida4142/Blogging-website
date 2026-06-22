<?php
// Include database connection
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Delete the post from the database
    $query = "DELETE FROM blog WHERE bid = '$post_id'";

    if (mysqli_query($con, $query)) {
        // Redirect back to manage_blog.php after successful deletion
        header("Location: manage_blogs.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
