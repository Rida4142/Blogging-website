<?php
// Include database connection
include('conn.php');
include('./includes/header.php');
// Fetch blogs from the database
$query = "SELECT b.bid, b.uid, b.btitle, b.bcontent, b.bcreated_at, u.uname FROM blog b JOIN users u ON b.uid = u.uid";
$result = mysqli_query($con, $query);
?>

<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-light">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Manage Blogs</h2>
                        </div>
                        <div class="card-body">
                            <p class="text-muted text-center mb-4">Here is the list of blogs. You can edit or delete a blog using the actions below.</p>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Content</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Actions</th>
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
                                                        <td>{$row['btitle']}</td>
                                                        <td>" . substr($row['bcontent'], 0, 50) . "...</td>
                                                        <td>{$row['bcreated_at']}</td>
                                                        <td>
                                                            <form method='POST' action='delete_post.php' class='d-inline' onsubmit='return confirmDelete();'>
                                                                <input type='hidden' name='post_id' value='{$row['bid']}'>
                                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                            </form>
                                                            <a href='edit_post.php?post_id={$row['bid']}' class='btn btn-warning btn-sm'>Edit</a>
                                                        </td>
                                                    </tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='6' class='text-center'>No blogs found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <small class="text-muted">Admin Panel - Blog Management</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript confirmation before deleting a blog
    function confirmDelete() {
        return confirm("Are you sure you want to delete this blog?");
    }
</script>

<?php
// Include footer
include('./includes/footer.php');
?>
