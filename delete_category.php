<?php
// Include database connection
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];

    // Delete the category from the database
    $query = "DELETE FROM category WHERE category_id = '$category_id'";
    if (mysqli_query($con, $query)) {
        // Redirect to the manage categories page after successful deletion
        header("Location: manage_categories.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
