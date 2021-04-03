<?php
require 'includes/header.php';
?>

<main>
<link rel="stylesheet" href="css/gallery.css">
    
    <h1>Products needing approved</h1>
        <div class="gallery-container">
            <?php 
                include_once 'includes/dbhandler.php';
                $sql = "SELECT * FROM products where approved=0";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'SQL Failure';
                }
                else{
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<div class="card"> 
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

</main>