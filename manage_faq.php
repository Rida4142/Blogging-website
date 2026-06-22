<?php
// Include database connection
include('conn.php');
include('./includes/header.php');

// Fetch FAQs from the database
$query = "SELECT f.fid, f.uid, f.fquestion, f.fanswer, f.fcat, u.uname FROM faq f JOIN users u ON f.uid = u.uid";
$result = mysqli_query($con, $query);
?>

<!-- HTML for Manage FAQs with Card Layout -->
<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-light">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Manage FAQs</h2>
                        </div>
                        <div class="card-body">
                            <p class="text-muted text-center mb-4">Here is the list of FAQs. You can delete an FAQ by clicking the button below.</p>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Question</th>
                                            <th scope="col">Answer</th>
                                            <th scope="col">Category</th>
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
                                                        <td>{$row['fquestion']}</td>
                                                        <td>{$row['fanswer']}</td>
                                                        <td>{$row['fcat']}</td>
                                                        <td>
                                                            <form method='POST' action='delete_faq.php' onsubmit='return confirmDelete();'>
                                                                <input type='hidden' name='faq_id' value='{$row['fid']}'>
                                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='6' class='text-center'>No FAQs found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <small class="text-muted">Admin Panel - FAQ Management</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript confirmation before deleting an FAQ
    function confirmDelete() {
        return confirm("Are you sure you want to delete this FAQ?");
    }
</script>

<?php
// Include footer
include('./includes/footer.php');
?>
