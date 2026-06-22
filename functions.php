<?php
// Function to record user activity
function recordUserActivity($con, $uid, $activityType, $referenceId, $description) {
    // Check for valid inputs
    if (empty($uid) || empty($activityType) || empty($description)) {
        die("Invalid input: Missing required parameters.");
    }

    // Prepare the SQL query to insert activity log
    $query = "INSERT INTO activity_log (uid, activity_type, reference_id, activity_description, created_at) 
              VALUES (?, ?, ?, ?, NOW())";

    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        // Bind parameters: i = integer, s = string
        mysqli_stmt_bind_param($stmt, 'isis', $uid, $activityType, $referenceId, $description);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            return true; // Success
        } else {
            die("Error inserting activity log: " . mysqli_error($con));
        }
    } else {
        die("Database Error: " . mysqli_error($con));
    }
}

// Usage Example
/*
$con = mysqli_connect("localhost", "username", "password", "database_name");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Example call to the function
recordUserActivity($con, 1, 'BLOG_VIEW', 101, 'Viewed blog titled "My First Blog".');
*/
?>
