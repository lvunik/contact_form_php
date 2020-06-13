<?php 
    //check if not yet login redirect to login page
    session_start();
    if(isset($_SESSION['status'])&&$_SESSION['status']!="login"){
        header("location: login.php");
    }

    $title = "Message Dashboard";

    include_once "include/partial/header.php";
    include_once "include/db.php";

?>
<body class="container-fluid">
    <nav class="navbar bg-light">
        <a href="login.php?logout" class="btn btn-primary ml-auto">Logout</a>
    </nav>
    <div class="row justify-content-center">
        <div class="col">
            <h1 class="text-center mb-4">Message Dashboard</h1>
            <table class="table table-ellipsis table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- select database and loop to table -->
                    <?php 
                        $sql = "SELECT name,email,subject,message,date FROM messages";
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)):
                    ?>
                        <tr>
                            <td><?=$row['name']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['subject']?></td>
                            <td><?=$row['message']?></td>
                            <td><?=$row['date']?></td>
                        </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>