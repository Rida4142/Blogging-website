<?php
// Include database connection
include('conn.php');
include('./includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch the category to edit from the database
    $query = "SELECT * FROM category WHERE category_id = '$category_id'";
    $result = mysqli_query($con, $query);
    $category = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $category_name = mysqli_real_escape_string($con, $_POST['category_name']); // Sanitize input

    // Update the category name in the database
    $query = "UPDATE category SET category_name = '$category_name' WHERE category_id = '$category_id'";
    if (mysqli_query($con, $query)) {
        // Redirect to the manage categories page after successful update
        header("Location: manage_categories.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!-- HTML for Edit Category Form with Card Layout -->
<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-light">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Edit Category</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="edit_category.php">
                                <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $category['category_name']; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include('./includes/footer.php');
?>
