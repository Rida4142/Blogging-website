<?php
// Include database connection
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    // Delete the comment from the database
    $query = "DELETE FROM blog_comment WHERE cid = '$comment_id'";

    if (mysqli_query($con, $query)) {
        // Redirect back to the manage comments page after successful deletion
        header("Location: manage_comments.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
