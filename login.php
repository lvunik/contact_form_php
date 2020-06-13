<?php
    session_start();
    //logout when get this
    if(isset($_GET['logout'])){
        $_SESSION['status']='logout';
    }
    //check if not yet logout stay login
    if(isset($_SESSION['status'])&&$_SESSION['status']=="login"){
        header("location: message.php");
    }
    
    //global variable
    $title = "Login Page";
    $login = "";
    //include file;
    include_once "include/partial/header.php";
    include_once "include/db.php";
    //check password;
    if(isset($_POST['username'])){
        if(!empty($_POST['username'])&&!empty($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT password FROM user 
                    WHERE username = '$username'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                $pwd = $row['password'];
                if($pwd !== $password){
                    $login = "fail";
                }else{
                    $_SESSION['status']= "login";
                    header("location: message.php");
                }
            }else{
                $login = "fail";
            }
        }
    }

?>
<body class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-7 col-lg-5">
            <h1 class="text-center">Login</h1>
            <form class="form" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <!-- check if login fail display fail message -->
                    <?php if($login=="fail"): ?>
                        <div class="alert alert-danger d-block mt-3">
                            username and password does not match
                        </div>
                    <?php endif;?>
                </div>
                <button class="btn btn-primary form-control">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
