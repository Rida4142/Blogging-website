<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('conn.php');
include('functions.php'); // Include the file where `recordUserActivity` is defined

// Check if the connection is established
if (!$con) {
    $_SESSION['status'] = "Failed to establish connection with database. Try Again Later!";
    header("Location: dashboard.php");
    exit(0);
}

// Check if blog content is submitted and user is authenticated
if (isset($_POST['blog_content']) && isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    $current_user_id = $_SESSION['auth_user']['wid']; // User ID from session
    $title = mysqli_real_escape_string($con, $_POST['blog_title']);
    $c = $_POST['blog_content'];
    $content = mysqli_real_escape_string($con, $c);

    // Insert blog into the database
    $submit_query = "INSERT INTO blog(uid, btitle, bcontent) VALUES($current_user_id, '$title', '$content')";
    $submit_query_run = mysqli_query($con, $submit_query);

    if ($submit_query_run) {
        // Fetch the last inserted blog ID
        $last_blog_id = mysqli_insert_id($con);

        // Log the "BLOG_SUBMIT" activity
        recordUserActivity($con, $current_user_id, 'BLOG_SUBMIT', $last_blog_id, "Submitted a blog titled '$title'");

        $_SESSION['status'] = "Blog posted!";
        header("Location: explore.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Blog is too long! Try Again!";
        header("Location: dashboard.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Unauthorized access. Please log in first!";
    header("Location: login.php");
    exit(0);
}
?>
