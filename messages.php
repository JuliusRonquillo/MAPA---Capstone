<?php 
    require_once "phpsession.php";
    if(isset($_SESSION['messagesent'])){
        if ($_SESSION['messagesent'] == TRUE){
            $_SESSION['messagesent'] = FALSE;
            echo "<script>alert('Message Sent!');</script>";
        }
    }
    if (isset($_GET['chat'])) {
        echo '<h2 style="font-family: Roboto, Arial, sans-serif;">Open chat</h2>';
    }else{
    $user = "SELECT * FROM accounts WHERE id={$_SESSION['sessionId']};";
    $userRun = mysqli_query($conn, $user);
    while($rowuser = mysqli_fetch_array($userRun)){
        $username = $rowuser['username'];
        $userid = $rowuser['id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS//messages.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap" rel="stylesheet">
        <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Messages</title>
    </head>
    <body>
        <?php include "header.php";
        $query = "SELECT * FROM messages WHERE sender_id='".$userid."' OR receiver_id='".$userid."'";
        $queryRun = mysqli_query($conn, $query);
        $temp = 0;
        $names = array();
        ?>
        <div class="feed">
            <div class="chatnames">
                <h2>Chats</h2>
                <table>
                    <?php
                    while($row = mysqli_fetch_array($queryRun)){
                        $temp2 = $row['receiver_id'];
                        $temp3 = $row['sender_id'];
                        if ($temp2 == $userid){
                            $user2id = $row['sender_id'];
                        }elseif ($temp3 == $userid) {
                            $user2id = $row['receiver_id'];
                        }
                        if ($user2id != $temp){
                            if ($user2id != $userid){
                                $query2 = "SELECT * FROM accounts WHERE id='".$user2id."'";
                                $query2Run = mysqli_query($conn, $query2);
                                while($row2 = mysqli_fetch_array($query2Run)){
                                    $user2name = $row2['username'];
                                }
                                if (!in_array($user2name, $names)){
                                echo 
                                '<tr>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="submit" id="chatname" name="username2" class="chatname" value=' . $user2name . ' />
                                        </td>
                                    </form>
                                </tr>';}
                                array_push($names, $user2name);
                            }
                            
                        }
                        
                        $temp = $user2id;
                    }
                    ?>
                </table>
            </div>
            <div id="openmessage">
                <?php
                if (isset($_POST['username2']))
                {
                    $username2 = $_POST['username2'];
                    echo '<iframe src="chatbox.php?user2name=' . $username2 . '&userid=' . $userid . '&username=' . $username . '" width="100%" height="500" style="border:1px solid black;">
                    </iframe>';
                }
                ?>
            </div>
        </div>
    </body>
    <?php include "footer.php"?>
</html>
<?php } ?>