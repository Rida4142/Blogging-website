<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="main-div">
    <div class="navbar">
        <h1><a href="/index.php">BlogsNet.com</a></h1>
        <div class="pages">
            <ul>
                <?php if (!isset($_SESSION['authenticated'])): ?>
                    <li><a href="/adminlogin.php">Admin Login</a></li>
                    <li><a href="/support.php">Support</a></li>
                    <li><a href="/login.php">Login</a></li>
                    <li><a href="/signin.php">Sign In</a></li>
                <?php endif ?>
                <?php if (isset($_SESSION['authenticated'])): ?>
                    <li>
                        <a href="/dashboard.php" class="profile-button">
                            <div class="profile-card-small">
                                <div class="profile-pic-small">
                                    <?php
                                        $profilePic = 'profile_man.png';
                                        if (isset($_SESSION['auth_user']['wgender']) && $_SESSION['auth_user']['wgender'] === 'FEMALE') {
                                            $profilePic = 'profile_woman.png';
                                        }
                                    ?>
                                    <img src="/assets/<?=$profilePic ?>" alt="Profile Picture" class="profile-img">
                                </div>
                                <span class="profile-name"><?= $_SESSION['auth_user']['wusername']; ?></span>
                            </div>
                        </a>
                    </li>
                    <li><a href="/postfaq.php">FAQ</a></li>
                    <li><a href="/explore.php">Explore</a></li>
                    <li><a href="/post.php">Post</a></li>
                    <li><a href="/display_activitylog.php">Activity Log</a></li>
                    <li><a href="/logout.php">Log Out</a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>
