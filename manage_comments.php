<?php
// Include database connection
include('conn.php');
include('./includes/header.php');

// Fetch comments from the database
$query = "SELECT c.cid, c.uid, c.comment_text, u.uname FROM blog_comment c JOIN users u ON c.uid = u.uid";
$result = mysqli_query($con, $query);
?>

<!-- HTML for Manage Comments with Card Layout -->
<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-light">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Manage Comments</h2>
                        </div>
                        <div class="card-body">
                            <p class="text-muted text-center mb-4">Here is the list of comments made by users. You can delete a comment by clicking the button below.</p>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($result) > 0) {
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>
                                                        <th scope='row'>{$count}</th>
                                                        <td>{$row['uname']} (ID: {$row['uid']})</td>
                                                        <td>{$row['comment_text']}</td>
                                                        <td>
                                                            <form method='POST' action='delete_comment.php' onsubmit='return confirmDelete();'>
                                                                <input type='hidden' name='comment_id' value='{$row['cid']}'>
                                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='4' class='text-center'>No comments found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <small class="text-muted">Admin Panel - Comment Management</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript confirmation before deleting a comment
    function confirmDelete() {
        return confirm("Are you sure you want to delete this comment?");
    }
</script>

<?php
// Include footer
include('./includes/footer.php');
?>
