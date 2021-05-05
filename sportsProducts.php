<?php require 'includes/header.php'; ?>

<link rel="stylesheet" href="css/gallery.css">

<!--This page is for connected to the 'all products' button in the main gallery it connects to the dabase 
    and returns all products that are there as of now. Eventually this needs to be updated so that it 
    only returns products that are marked as approved -->

<main> 
    <div class="bg-cover">    
        <h1>Sporting Goods</h1>
            <div class="gallery-container">
                <?php 
                    include_once 'includes/dbhandler.php';
                    $sql = "SELECT * FROM products WHERE productType='sports' ORDER BY upload_date DESC";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'SQL Failure';
                    }
                    else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="productCard"> 
                                    <a href="review.php?id='.$row['pid'].'&productName='.$row["title"].'&picpath='.$row["picpath"].' ">
                                    <img src="products/'.$row["picpath"].'">
                                    <h3>'.$row["title"].'</h3>
                                    <p>'.$row["description"].'</p>
                                </a>
                            </div>';
                        }

                    }
                ?>
            </div>
    </div>
</main>