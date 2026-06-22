<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('conn.php');
include('functions.php'); // Include the file containing `recordUserActivity`

if (isset($_POST['faq_question']) && isset($_POST['faq_answer']) && isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    // Retrieve user ID from session
    $current_user_id = $_SESSION['auth_user']['wid'];

    // Sanitize inputs
    $question = mysqli_real_escape_string($con, $_POST['faq_question']); // Question as plain text
    $answer = mysqli_real_escape_string($con, $_POST['faq_answer']);     // Answer as plain text

    // Insert the FAQ into the database
    $submit_query = "INSERT INTO faq(uid, fquestion, fanswer) VALUES($current_user_id, '$question', '$answer')";
    $submit_query_run = mysqli_query($con, $submit_query);

    if ($submit_query_run) {
        // Retrieve the newly inserted FAQ ID
        $faq_id = mysqli_insert_id($con);

        // Log the activity
        recordUserActivity($con, $current_user_id, 'FAQ_POST', $faq_id, "Posted FAQ: '$question'");

        // Provide success feedback
        $_SESSION['status'] = "FAQ posted successfully!";
        header("Location: dashboard.php");
        exit(0);
    } else {
        // Log failure activity (optional)
        recordUserActivity($con, $current_user_id, 'FAQ_POST_FAILED', NULL, "Failed to post FAQ: '$question'");

        // Provide failure feedback
        $_SESSION['status'] = "Could not submit FAQ. Try again later!";
        header("Location: dashboard.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Invalid request. Please fill in both question and answer.";
    header("Location: dashboard.php");
    exit(0);
}
?>
