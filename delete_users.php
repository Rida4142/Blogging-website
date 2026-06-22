<?php
// Include database connection
include('conn.php');

// Check if the user_id is set
if (isset($_POST['user_id'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    // SQL query to delete the user
    $delete_query = "DELETE FROM users WHERE uid = '$user_id'";
    if (mysqli_query($con, $delete_query)) {
        // Redirect back to the manage users page with a success message
        header("Location: manage_users.php?message=User deleted successfully");
        exit();
    } else {
        // Redirect back to the manage users page with an error message
        header("Location: manage_users.php?error=Failed to delete user");
        exit();
    }
} else {
    // Redirect if no user_id is set
    header("Location: manage_users.php");
    exit();
}
?>
