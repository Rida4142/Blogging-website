<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("includes/exploreheader.php");
include('conn.php');
include('authenticated.php'); // Ensures the user is logged in

$page_title = "Dashboard - BlogsNet";
include('includes/header.php');
include('includes/navbar.php');

// Ensure the user is logged in and has a valid session
if (!isset($_SESSION['auth_user']['wid'])) {
    die("User ID is not set in the session");
}

$uid = $_SESSION['auth_user']['wid']; // Get the user ID from the session

// Fetch gender for profile picture
$gender_query = "SELECT gender FROM gender WHERE uid = ? LIMIT 1";
$gender_stmt = mysqli_prepare($con, $gender_query);
mysqli_stmt_bind_param($gender_stmt, 'i', $uid);
mysqli_stmt_execute($gender_stmt);
$gender_result = mysqli_stmt_get_result($gender_stmt);
$gender = mysqli_fetch_assoc($gender_result);

// Determine profile picture
$profilePic = ($gender['gender'] ?? 'MALE') === 'MALE' ? 'profile_man.png' : 'profile_woman.png';

// Query to fetch activity logs for the user, ordered by 'created_at'
$query = "SELECT activity_type, activity_description, created_at FROM activity_log WHERE uid = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'i', $uid);
mysqli_stmt_execute($stmt);
$query_run = mysqli_stmt_get_result($stmt);

// Store gender in session for profile details
$_SESSION['auth_user']['wgender'] = $gender['gender'] ?? 'N/A';
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="main-div">
                    <div class="card profile-card">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo '<div class="alert alert-success"><h5>' . $_SESSION['status'] . '</h5></div>';
                            unset($_SESSION['status']);
                        }
                        ?>
                        <div class="card-header text-center">
                            <h4>Profile</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if (!$_SESSION['authenticated']) {
                                echo '<div class="alert alert-danger"><h3>Login to get access</h3></div><hr>';
                            }
                            ?>
                            <div class="profile-info">
                                <div class="profile-pic">
                                    <form method="POST" action="gender.php">
                                        <button type="submit" name="toggle_gender" value="toggle" style="border: none; background: transparent; padding: 0;">
                                            <img src="/assets/<?= $profilePic ?>" alt="Profile Picture" class="profile-img">
                                        </button>
                                    </form>
                                </div>
                                <div class="profile-details">
                                    <h3>User ID: <span class="s1"><?= $_SESSION['auth_user']['wid'] ?? 'N/A' ?></span></h3>
                                    <h3>Name: <span class="s2"><?= $_SESSION['auth_user']['wusername'] ?? 'N/A' ?></span></h3>
                                    <h3>Email: <span class="s3"><?= $_SESSION['auth_user']['wemail'] ?? 'N/A' ?></span></h3>
                                    <h3>Phone: <span class="s4"><?= $_SESSION['auth_user']['wphone'] ?? 'N/A' ?></span></h3>
                                    <h3>Gender: <span class="s5"><?= $_SESSION['auth_user']['wgender'] ?></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <hr>
        <div class="row">
            
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
