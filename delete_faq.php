<?php
// Include database connection
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['faq_id'])) {
    $faq_id = $_POST['faq_id'];

    // Delete the FAQ from the database
    $query = "DELETE FROM faq WHERE fid = '$faq_id'";

    if (mysqli_query($con, $query)) {
        // Redirect back to the manage FAQs page after successful deletion
        header("Location: manage_faq.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

