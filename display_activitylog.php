<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("includes/exploreheader.php");
include('conn.php');
include('authenticated.php'); // Ensures the user is logged in

// Ensure the user is logged in and has a valid session
if (!isset($_SESSION['auth_user']['wid'])) {
    die("User ID is not set in the session");
}

$uid = $_SESSION['auth_user']['wid']; // Get the user ID from the session

// Query to fetch activity logs for the user, ordered by 'created_at'
$query = "SELECT activity_type, activity_description, created_at FROM activity_log WHERE uid = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'i', $uid);
mysqli_stmt_execute($stmt);
$query_run = mysqli_stmt_get_result($stmt);

// Fetch gender for profile picture
$gender_query = "SELECT gender FROM gender WHERE uid = ? LIMIT 1";
$gender_stmt = mysqli_prepare($con, $gender_query);
mysqli_stmt_bind_param($gender_stmt, 'i', $uid);
mysqli_stmt_execute($gender_stmt);
$gender_result = mysqli_stmt_get_result($gender_stmt);
$gender = mysqli_fetch_assoc($gender_result);

// Determine profile picture
$profilePic = ($gender['gender'] ?? 'MALE') === 'MALE' ? 'profile_man.png' : 'profile_woman.png';

$page_title = "Activity Log - BlogsNet";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center mb-4">Your Activity Log</h3>
                <div class="blog-list">
                    <?php
                    if (mysqli_num_rows($query_run) > 0) {
                        // Loop through the activity logs and display them as cards
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $activityType = $row['activity_type'] ?? 'Unknown Activity';
                            $description = $row['activity_description'] ?? 'No Description';
                            $createdAt = $row['created_at'] ?? null;
                            ?>
                            <div class="blog-card">
                                <div class="pic">
                                    <img src="/assets/<?= $profilePic ?>" alt="Profile Picture">
                                </div>
                                <div class="blog-item">
                                    <h3><?= htmlspecialchars($activityType) ?></h3>
                                    <p><?= htmlspecialchars($description) ?></p>
                                    <p class="poster1"><?= $createdAt ? date('F j, Y, g:i a', strtotime($createdAt)) : 'No Timestamp' ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        // If no activity logs are found
                        echo "<p class='text-center'>No activity found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
