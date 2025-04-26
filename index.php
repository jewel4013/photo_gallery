<?php
include 'includes/header.php';

$query = "SELECT * FROM images ORDER BY upload_date DESC";
$stmt = $pdo->query($query);

$images = $stmt->fetchAll();

?>


<h1>This is Photo Gallery</h1>

<div class="row">
    <?php if(count($images) > 0){
        foreach($images as $image){ ?>
            <div class="card" style="width: 18rem;">
                <img src="assets/images/<?php echo $image['filename'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $image['title'] ?></h5>
                    <p class="card-text">
                        <?php echo $image['description'] ?>
                    </p>
                    <p>
                        <?php echo date('d, M Y', strtotime($image['upload_date'])) ?>
                    </p>        
                </div>
        </div>
    <?php 
        }        
    }else{ ?>
        <div class="alert alert-danger col-md-6" role="alert">
            No Data Found.
        </div>
    <?php } ?>
        

</div>




<?php
include 'includes/footer.php';
?>