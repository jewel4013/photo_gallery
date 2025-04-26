<?php
include 'includes/header.php';


$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desctiption = $_POST['description'];
    $image = $_FILES['image'];    
//    print_r($image);

    //Simple form validation 
    if (empty($title) || empty($desctiption) || empty($image)) {
        $error = "Please fill in all options.";
    }else{       
        $target_dir = 'assets/images/';
        //
        if(!file_exists($target_dir)){
            mkdir($target_dir, 0777, true);
        }

        $file = $image['name'];
        $newFile = uniqid().$file;

        $finalFile = $target_dir.$newFile;

        //File size filtering. 
        if($image['size'] > 5000000){
            $error = "The image size should be less then 5gb.";
        }else{
            if(move_uploaded_file($image['tmp_name'], $finalFile)){
                $query = "INSERT INTO images(title, description, filename) VALUES(:title, :description, :filename)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':title' => $title,
                    ':description' => $desctiption,
                    ':filename' => $newFile
                ]);

                $success = "Image upload successful.";
                $title ="";
                $desctiption ="";
            }else{
                $error = "Your image upload faild.";
            }
        }
   }



}
?>



<div class="my-4">
    <h2>Photo Gallery</h2>
</div>

<?php if ($success): ?>
    <div class="alert alert-success col-md-6" role="alert">
        <?php echo $success; ?>
    </div>
<?php endif ?>

<?php if ($error): ?>
    <div class="alert alert-danger col-md-6" role="alert">
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