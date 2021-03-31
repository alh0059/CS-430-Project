<?php

//isset is a true or false and checks to see if anything is associated with the POST variable.
// There is either something there or it will be null.
if(isset($_POST['login-submit'])){
    require 'dbhandler.php';
    $uname_email = $_POST['login-uname'];
    $uname_pwd = $_POST['login-pwd'];

    //There must be a value for both uname and emial if they are signing-in. 
    if(empty($uname_email) || empty($uname_pwd)){
        header("Location: ../login.php?error=EmptyField");
        exit();
    }
    // * means everything
    $sql = "SELECT * FROM users WHERE uname =? or email =?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
            
        headerer("Location: ../login.php?error=SQLInjection");
        exit();
    }

    else{
        mysqli_stmt_bind_param($stmt,"ss",$uname_email,$uname_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        if(empty($data)){
            header("Location: ../login.php?error=UserDNE");
            exit();
        }
        else{
            $pass_check = password_verify($uname_pwd, $data['password']); 
            if($pass_check == true){
                session_start();
               
                $_SESSION['uid'] = $data['uid'];
                $_SESSION['fname'] = $data['fname'];
                $_SESSION['username'] = $data['uname'];
                
                header("Location: ../profile.php?login=Success");
                exit();
            }   
            else{
                header("Location: ../login.php?error=WrongPass");
                exit();
            }
        }
    }

}
else{
    header("Location: ../login.php");
    exit();
}
