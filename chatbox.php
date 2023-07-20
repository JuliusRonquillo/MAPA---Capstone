<?php
    require 'connection.php';
    require_once "phpsession.php";

    if (isset($_GET['user2name']) && isset($_GET['userid']) && isset($_GET['username'])) {
        $user2name = $_GET['user2name'];
        $userid = $_GET['userid'];
        $username = $_GET['username'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS//messages.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="username">
        <b><?php if (isset($user2name)){ echo $user2name; ?></b>
        </div>
<table class="chatbox">
    <?php
        $sql = "SELECT * FROM accounts WHERE username='".$user2name."'";
        $sqlRun = mysqli_query($conn, $sql);
        while($sqlrow = mysqli_fetch_array($sqlRun)){
            $user2id = $sqlrow['id'];
        }
        $chat = "SELECT * FROM messages 
        WHERE sender_id='".$userid."' AND receiver_id='".$user2id."' 
        OR sender_id='".$user2id."' AND receiver_id='".$userid."'";
        $chatRun = mysqli_query($conn, $chat);
        while($chatrow = mysqli_fetch_array($chatRun)){
            $msgsender = $chatrow['sender_id'];
            if ($userid == $msgsender){
                $sender = $username;
                // $senderid = $userid;
                // $receiver = $user2name;
                // $receiverid = $user2id;
            }elseif ($user2id == $msgsender){
                $sender = $user2name;
                // $senderid = $user2id;
                // $receiver = $username;
                // $receiverid = $userid;
            }
            $msg = $chatrow['message'];
            echo
            '<tr>
                <td>
                    ' . $sender . '
                </td>
            </tr>
            <tr>
                <td>';
            if($sender == $username){
                echo 
                '<div class="fromuser">
                ' . $msg . '
                </div>';
            }elseif($sender == $user2name){
                echo 
                '<div class="fromotheruser">
                ' . $msg . '
                </div>';
            }
            echo 
                '</td>
            </tr>';
        }
        $sql = "SELECT * FROM accounts WHERE username='".$user2name."'";
        $sqlRun = mysqli_query($conn, $sql);
        while($sqlrow = mysqli_fetch_array($sqlRun)){
            $user2id = $sqlrow['id'];
        }
echo
'</table> 
<form action="sendmessage.php?sender=' . $userid . '&receiver=' . $user2name . '&chat=1" method="post">
    <textarea placeholder="Type message.." name="message" required class="textbox" rows="4"></textarea>
    <input type="submit" class="chatname" value="Send"></input>
</form>';
} else {
    echo '<h2>No messages yet.</h2>';
}
?>
<script>
    function autoScrolling() {
        window.scrollTo(0,document.body.scrollHeight);
    }
    autoScrolling();
</script>
</body>
</html>