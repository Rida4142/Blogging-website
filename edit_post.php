<?php
// Include database connection
include('conn.php');
include('./includes/header.php');

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Fetch the blog post details
    $query = "SELECT * FROM blog WHERE bid = '$post_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
    } else {
        die("Blog post not found");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    // Update the blog in the database
    $query = "UPDATE blog SET btitle = '$title', bcontent = '$content' WHERE bid = '$post_id'";

    if (mysqli_query($con, $query)) {
        // Redirect back to manage_blog.php after successful update
        header("Location: manage_blogs.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<div class="main-div">
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-light">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Edit Blog Post</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $post['bid']; ?>">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $post['btitle']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea name="content" class="form-control" rows="6" required><?php echo $post['bcontent']; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Update Post</button>
                            </form>
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

<?php
// Include footer
include('./includes/footer.php');
?>
