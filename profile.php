<?php
    require "connection.php";   
    require_once "phpsession.php";
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS//profile.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <title>My Profile</title>
    </head>
<body>
    <?php include "header.php"?>
    <p> My Profile </p> 
    <div class="profilediv">
        <ul class="profileul">
        <?php
        if (isset($_GET['id'])) {
            $query = "SELECT * FROM accounts WHERE id='".$id."'";
        }else{
            $query = "SELECT * FROM accounts WHERE id={$_SESSION['sessionId']};";
        }
        $queryRun = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($queryRun)){
            ?>
            <li>
                <p class="p"> <b>Name:&emsp;</b> <?php echo $row['name']; ?> </p>
            </li>
            <li>
                <p class="p"> <b>Username:&emsp;</b><?php echo $row['username']; ?> </p>
            </li>
            <li>
                <p class="p"> <b>Phone Number:&emsp;</b> <?php echo $row['phone']; ?> </p>
            </li>
            <li style="padding-top: 10%; padding-left: 30%">
                <a href="logout.php" class="lgoutbtn">Log Out</a>       
            </li>
            <?php
        }
        ?>
        </ul>
    </div>
    </body>
    <?php include "footer.php"?>
</html>