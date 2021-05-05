<?php 
require 'includes/header.php';
require "includes/dbhandler.php";
?>

<main>
<?php
    if(isset($_SESSION['uid'])){
        $prof_user = $_SESSION['username'];
        $sqlpro = "SELECT * FROM profile WHERE uname = '$prof_user';";
       
        $res = mysqli_query($conn, $sqlpro);
        $row = mysqli_fetch_array($res);
        
        $photo = $row['picpath'];;
        $approvedStatus = $row['approved'];
        $adminStatus = $row['administrator'];
        ?>
<style>
    .center-me {
        display: flex;
        justify-content: center;
        padding: 40px;
        text-align: "center";
    }

    #prof-display {
        display: block;
        width: 150px;
        margin: 10px auto;
        border-radius: 50%;
    }
    
    #uname-style {
        font-size: 20px;
        font-family: "Lucida Console", Courier, monospace;
        font-weight: bold;
        
    }

    
    </style>
    
    <script>
        function triggered(){
            document.querySelector("#prof-image").click();
        }
    
        function preview(e){
            if(e.files[0]){
                var reader = new FileReader();
    
                reader.onload = function(e){
                    document.querySelector('#prof-display').setAttribute('src',e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>

    <div class="h-100 center-me">
        <div class ="my-auto">

            <?php if($adminStatus = 1) : ?>
             <h5>Your account has administrator access!</h5>
             <a href="admin.php"><button>Open Administrator Tools</button></a>
            <?php else : ?>
             <h5>My Profile</h5>
            <?php endif; ?>
            
            <?php if($approvedStatus = 1) : ?>
             <h5>Your account has been approved for posting!</h5>
            <?php else : ?>
             <h5>Your account is still waiting on approval.</h5>
            <?php endif; ?>
                
            <form action="includes/upload-helper.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <img src="<?php echo $photo;?>" onclick="triggered();" id="prof-display">
                    <label class="center-me" for="prof-image" id="uname-style" style="text-align:center;"><?php echo $prof_user;?>  </label>
                    <input type="file" name="prof-image" id="prof-image" onchange="preview(this)" class="form-control" style="display: none;">
                </div>
                <div class="form-group">
                    <textarea name="bio" id="bio" cols="30" rows="10" placeholder="bio..." style="text-align: center;"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="prof-submit" class="btn btn-outline-success btn-lg btn-block">upload</button>
                </div>
            </form>
                
            <?php if($approvedStatus == 1) :  
                $sql = "SELECT * FROM reviews WHERE uname='$prof_user' LIMIT 20";
                $result = mysqli_query($conn, $sql);
                
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $uname = $row['uname'];
                        $prosql = "SELECT picpath from profile WHERE uname = '$uname';";
                        $res = mysqli_query($conn, $prosql);
                        $picpath = mysqli_fetch_assoc($res);
                
                        echo '
                        <div class="card mx-auto" style="width: 100%; padding: 5px; margin-bottom: 10px;"> 
                            <div class="media">
                            <img class="mr-3" src="'.$picpath['picpath'].'" style="max-width: 75px; max-height: 75px; border-radius: 50%;">
                                <div class="media-body">
                                    <p style="text-align:right">'.$row['rev_date'].'</p>
                                    <h6 style="text-align:right" class="mt-0">'.$row['uname'].'</h6>
                                    <h5 class="mt-0">'.$row['title'].'</h5>
                                    <p>'.$row['review_text'].'</p>
                                    <h6 >'.$row['productName'].'</h6>
                                </div>
                            </div>
                        </div>
                        
                        ';
                    }
                }
                else{
                    echo '<h5 style="text-align: center">No reviews, yet! Browse or request some products & share your thoughts on them. </h5>';
                }
                ?> 
            <?php endif; ?>
        </div>
    </div>  
    
<?php 
}
else{
    header("Location: login.php");
    exit();
}

?>

</main>