<?php 
require 'includes/header.php';
require 'includes/dbhandler.php';
?>

<main>
<link rel="stylesheet" href="CSS/admin.css">
<script src="js/upload-display.js"></script>
<?php
if (isset($_SESSION['uid'])) {
?>    
<div class="h-50 center-me text-center">
    <a href="approvalGallery.php"><button class="btn btn-secondary btn-lg btn-block">Browse product submissions</button></a>
</div>
<div class="h-50 center-me text-center">
    <div class="my-auto upload-container">
    <h5>New Product</h5>
        <form action="includes/gallery-helper.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <img src="Images\placeholder.jpg" onclick="triggered();" id="gallery-display">
            <input type="file" name="gallery-image" id="gallery-image" onchange="preview(this)" class="form-control" style="display: none;">
            <div class="form-group">
                <button class="btn btn-outline-dark btn-lg btn-block" onclick="triggered();">Click to add photo</button>
            </div>
            <div class="form-group">
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
            </div>
            <input type="text" name="productType" id="productType" class="form-control" placeholder="Product Type" required>
            
            </div>
                <div class="form-group">
                  <textarea name="description" id="description" cols="30" rows="3" placeholder="Description" style="text-align;"></textarea>  
                 </div>
                 <div class="form-group">
                    <button type="submit" name="gallery-submit" class="btn btn-outline-primary btn-lg btn-block">Add Product</button>
                </div>
        </form>   
    </div>
</div>
<div class="h-50 center-me text-center">  
    <a href="profile.php"><button class="btn btn-secondary btn-lg btn-block">Return to profile</button></a>
</div>

<?php 
}else{
    header("Location: ../login.php?error=Login");
    exit();
}
?>
</main>