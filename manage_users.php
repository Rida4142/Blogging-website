<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Include database connection
include('conn.php');
include('./includes/header.php');

// Fetch users from the database
$query = "SELECT uid, uname, uemail, uphone, uverification_status, ucreated_at FROM users";
$result = mysqli_query($con, $query);
?>

<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-light">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Manage Users</h2>
                        </div>
                        <div class="card-body">
                            <p class="text-muted text-center mb-4">Here is the list of registered users. You can delete a user by clicking the button below.</p>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Verification Status</th>
                                            <th scope="col">Created At</th>
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
                                                        <td>{$row['uname']}</td>
                                                        <td>{$row['uemail']}</td>
                                                        <td>{$row['uphone']}</td>
                                                        <td>" . ($row['uverification_status'] == 1 ? '<span class="badge bg-success">Verified</span>' : '<span class="badge bg-warning text-dark">Not Verified</span>') . "</td>
                                                        <td>{$row['ucreated_at']}</td>
                                                        <td>
                                                            <form method='POST' action='delete_users.php' onsubmit='return confirmDelete();'>
                                                                <input type='hidden' name='user_id' value='{$row['uid']}'>
                                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='7' class='text-center'>No users found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <small class="text-muted">Admin Panel - User Management</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript confirmation before deleting a user
    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
</script>
<?php
include('./includes/footer.php');
?>