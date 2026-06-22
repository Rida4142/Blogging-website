<?php 
include("conn.php");
?>

<div class="card">
    <div class="card-header">Comments</div>
    <div class="card-body">
        <?php
        $comment_query = "SELECT C.comment_text, U.uname 
                          FROM blog_comment AS C 
                          JOIN users AS U 
                          ON C.uid = U.uid 
                          WHERE C.bid = '$bid'";
        $comment_query_run = mysqli_query($con, $comment_query);

        if (mysqli_num_rows($comment_query_run) > 0) {
            while ($comment_row = mysqli_fetch_assoc($comment_query_run)) {
                $comment_text = $comment_row['comment_text'];
                $commenter_name = $comment_row['uname'];
                ?>
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
                    <div class="reply-div">
                        <button class="reply-btn" onclick="showReplyInput(this)">Reply</button>
                        <div class="reply-input-container"></div>
                    </div>
                </div>
            <?php
            }
        } else {
            echo "<p>No comments yet.</p>";
        }
        ?>

        <div class="form-group">
            <form action="comment.php?bid=<?php echo htmlspecialchars($bid); ?>" method="POST">
                <label for="comment-area" style="color: olive;">Comment Below</label>
                <textarea 
                    id="comment-area" 
                    name="comment" 
                    rows="5" 
                    cols="70" 
                    style="resize: none; padding: 15px; font-size: 1.2rem; color: #333; font-family: 'Ubuntu', sans-serif;">
                </textarea>
                <input 
                    type="submit" 
                    value="Submit" 
                    class="goback-btn" 
                    name="sub-comment" 
                    id="b1" 
                    style="cursor: pointer; padding: 10px 20px; background-color: olive; color: white; border: none; border-radius: 5px; font-size: 1.2rem; margin-top: 10px;
                    width: 870px;">
            </form>
        </div>
    </div>
</div>

<script>
function showReplyInput(button) {
    var replyInputContainer = button.nextElementSibling;
    if (!replyInputContainer.querySelector('textarea')) {
        var inputField = document.createElement('textarea');
        var submitButton = document.createElement('input');
        var form = document.createElement('form');
        form.method = "POST";
        form.action = "reply.php";
        submitButton.name = "reply-btn";
        submitButton.className = "reply-btn";
        submitButton.type = "submit";
        submitButton.id = "srb";
        inputField.name = 'reply_comment';
        inputField.rows = 4;
        inputField.cols = 110;
        inputField.style.resize = 'none';
        inputField.placeholder = 'Write your reply...';
        inputField.className = 'reply-input-container';
        form.appendChild(inputField);
        form.appendChild(submitButton);
        replyInputContainer.appendChild(form);
    }
}
</script>
