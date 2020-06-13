<?php
    //Global Variable
    $title = "Contact Form";
    $msg = ['isValid'=>""];
    $submitForm = "";
    //include file
    include_once "include/partial/header.php";
    include_once "include/func.php";
    include_once "include/db.php";
    //check if form submit not empty
    if(isset($_POST['name'])&&isset($_POST['email'])&&$_POST['subject']&&$_POST['message']){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        //validate length input
        validateInput($name,$msg,"name",6,30);
        validateInputEmail($email,$msg);
        validateInput($subject,$msg,"subject",6,50);
        validateInput($message,$msg,"message",15,150);
        //if valid insert to database
        if($msg["isValid"]==true){
            $sql = "INSERT INTO messages (name,email,subject,message) 
            VALUES ('$name','$email','$subject','$message');";
            if(mysqli_query($conn,$sql)){
                $submitForm = "success";
            }else{
                echo mysqli_error($conn);
            }
        }else{
            $submitForm = "failed";        
        }
        
    }
?>
<body class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8 col-lg-4 mt-3">
            <!-- display when form submit failed or success -->
            <?php if($submitForm=="success"):?>
                <div class="alert alert-success">
                    Your form has been submitted
                </div>
            <?php endif;?>
            <?php if($submitForm=="failed"):?>
                <div class="alert alert-danger">
                    Failed to submit your form
                </div>
            <?php endif;?>
            <!--  -->
            <h1 class="text-center">Contact Form</h1>
            <form method="POST" class="form">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control <?= validateMsg($msg['name'],true)?>" required>
                    <?= validateMsg($msg['name'])?>  <!--return input error message(or classname)-->
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control <?= validateMsg($msg['email'],true)?>" required>
                    <?= validateMsg($msg['email'])?> <!--return input error message(or classname)-->
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control <?= validateMsg($msg['subject'],true)?>" required>
                    <?= validateMsg($msg['subject'])?> <!--return input error message(or classname)-->
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" class="form-control <?= validateMsg($msg['message'],true)?>" cols="30" rows="6" required></textarea> 
                    <?= validateMsg($msg['message'])?>  <!--return input error message(or classname)-->
                </div>
                <button type="submit" class="btn btn-primary form-control">Send</button>
            </form>
        </div>
    </div>
</body>
</html>