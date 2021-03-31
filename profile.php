<?php 
require 'includes/header.php';
require "includes/dbhandler.php";
?>

<main>
<?php
    if(isset($_SESSION['uid'])){
        $prof_user = $_SESSION['username'];
        $sqlpro = "SELECT * FROM profile WHERE uname = '$prof_user';";
        $sqlpro2 = "SELECT approved FROM users WHERE uname = '$prof_user';";
        $res = mysqli_query($conn, $sqlpro);
        $res2 = mysqli_query($conn, $sqlpro2);

        $row = mysqli_fetch_array($res);
        $row2 = mysqli_fetch_array($res2);
        $photo = $row['picpath'];
        $approvedStatus = $row2['approved'];
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