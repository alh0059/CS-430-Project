 
 <?php
require 'includes/header.php'
  ?>

<main>
  <link rel="stylesheet" href="css/login.css">
    <div class="bg-cover">
        <div class="h-100 center-me">
            <div class ="my_auto">
                <form class="form-signin" action="includes/login-helper.php" method="post" style="background: white;">
                   <img src="Images/user-login.jpg" class="loginImage">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputEmail" class="sr-only">Username or Email Address</label>
                    <input type="text" id="inputEmail" name = "login-uname" class="form-control" placeholder="Username/ Email address" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="login-pwd" class="form-control" placeholder="Password" required>
                    <div class="checkbox mb-3" style="text-align: left;">
                      <label>
                        <input type="checkbox" value="remember-me"> Remember me
                      </label>
                    </div>
                    <button class="btn btn-lg btn-dark btn-block" name="login-submit" type="submit">Sign in</button>   
                    <br> 
                    <p class="h5 mb-3 font-weight-normal">Don't have an account?</p>
                    <a class="btn btn-lg btn-dark btn-block" href="signup.php" role="button">Sign Up Now!</a>            
                    <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
                </form>
            </div>
        </div>
      
    </div>
</main>