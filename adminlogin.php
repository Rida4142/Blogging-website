<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['admin_login_btn'])) {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    // Hardcoded credentials for admin
    $admin_hardcoded_email = "admin@123";
    $admin_hardcoded_password = "admin123";

    if ($admin_email === $admin_hardcoded_email && $admin_password === $admin_hardcoded_password) {
        $_SESSION['admin_authenticated'] = true;
        $_SESSION['status'] = "Welcome, Admin!";
        header("Location: admin_panel.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Invalid Admin Credentials!";
        header("Location: adminlogin.php");
        exit(0);
    }
}

$page_title = "Admin Login to ";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="login-card">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo '<div class="alert alert-danger"><h5>' . $_SESSION['status'] . '</h5></div>';
                            unset($_SESSION['status']);
                        }
                        ?>
                        <h2>Admin Login</h2>
                        <form method="POST" action="adminlogin.php">
                            <div class="form-group">
                                <input type="text" placeholder="Admin Username" name="admin_email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" name="admin_password" required>
                            </div>
                            <input type="submit" name="admin_login_btn" class="btn-std" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
