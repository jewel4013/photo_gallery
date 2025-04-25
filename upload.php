<?php
include 'includes/header.php';


$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desctiption = $_POST['description'];
    $image = $_FILES['image'];

    if (empty($title) || empty($desctiption)) {
        $error = "Please fill in all options.";
    }



}
?>



<div class="my-4">
    <h2>Photo Gallery</h2>
</div>

<?php if ($success): ?>
    <<div class="alert alert-success" role="alert">
        <?php echo $success; ?>
    </div>
<?php endif ?>

<?php if ($error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif ?>




    <div class="my-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="description"
                                    name="description"> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" />
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <?php
    include 'includes/footer.php';
    ?>