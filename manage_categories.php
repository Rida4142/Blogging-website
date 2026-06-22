<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Include database connection
include('conn.php');
include('./includes/header.php');

// Fetch categories from the database
$query = "SELECT category_id, category_name FROM category";
$result = mysqli_query($con, $query);
?>

<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-light">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Manage Categories</h2>
                        </div>
                        <div class="card-body">
                            <p class="text-muted text-center mb-4">Here is the list of existing categories. You can add, edit, or delete categories as needed.</p>

                            <!-- Add Category Button -->
                            <div class="text-end mb-3">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Category Name</th>
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
                                                        <td>{$row['category_name']}</td>
                                                        <td>
                                                            <a href='edit_category.php?category_id={$row['category_id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                            <form method='POST' action='delete_category.php' onsubmit='return confirmDelete();' class='d-inline'>
                                                                <input type='hidden' name='category_id' value='{$row['category_id']}'>
                                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='3' class='text-center'>No categories found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <small class="text-muted">Admin Panel - Category Management</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="add_category.php">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript confirmation before deleting a category
    function confirmDelete() {
        return confirm("Are you sure you want to delete this category?");
    }
</script>

<?php
// Include footer
include('./includes/footer.php');
?>
