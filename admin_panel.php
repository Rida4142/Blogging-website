<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    $_SESSION['status'] = "Access Denied! Admin Login Required.";
    header("Location: adminlogin.php");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <?php include('includes/header.php'); ?>
</head>
<body>
<?php include('includes/navbar.php'); ?>

<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-secondary text-white text-center">
                            <h2>Welcome, Admin!</h2>
                        </div>
                        <div class="card-body text-center">
                            <p class="text-muted">Select an action to perform:</p>
                            <div class="admin-buttons my-4">
                                <button class="btn btn-outline-secondary mx-2 my-2" onclick="window.location.href='delete_users.php'">
                                    Manage Users
                                </button>
                                <button class="btn btn-outline-secondary mx-2 my-2" onclick="window.location.href='manage_blogs.php'">
                                    Manage Posts
                                </button>
                                <button class="btn btn-outline-secondary mx-2 my-2" onclick="window.location.href='manage_faq.php'">
                                    Manage FAQs
                                </button>
                                <button class="btn btn-outline-secondary mx-2 my-2" onclick="window.location.href='manage_comments.php'">
                                    Manage Comments
                                </button>
                                <button class="btn btn-outline-danger mx-2 my-2" onclick="window.location.href='adminlogout.php'">
                                    Logout
                                </button>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <small class="text-muted">Admin Dashboard - BlogsNet</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
</body>
</html>
