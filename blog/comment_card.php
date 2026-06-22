<div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                            <?php 
                            $uid = $_SESSION['auth_user']['wid'];
                            $gender_query = "SELECT * FROM gender WHERE uid = '$uid' LIMIT 1";
                            $gender_query_run = mysqli_query($con,$gender_query);
                            $gender = mysqli_fetch_assoc($gender_query_run);
                            if($gender['gender'] == 'MALE') {
                                $profilePic = 'profile_man.png';
                            } else {
                                $profilePic = 'profile_woman.png';
                            }
                            ?>
                                <img src="/assets/<?=$profilePic?>" alt="Profile Picture" class="profile-img">
                            </div>
                            <div class="col">
                                <h5 class="card-title"><?php echo htmlspecialchars($commenter_name); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($comment_text); ?></p>
                            </div>
                        </div>
                    </div>