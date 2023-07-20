<?php
    require 'connection.php';
    require_once "phpsession.php";

    if (isset($_GET['sender']) && isset($_GET['receiver']) ) {
        $senderid = $_GET['sender'];
        $receivername = $_GET['receiver'];
    }

    $query = "SELECT * FROM accounts WHERE id='".$senderid."'";
    $queryRun = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($queryRun)){
        $sendername = $row['username'];

    }

    $query2 = "SELECT * FROM accounts WHERE username='".$receivername."'";
    $query2Run = mysqli_query($conn, $query2);
    while($row2 = mysqli_fetch_array($query2Run)){
        $receiverid = $row2['id'];
    }

    $message = $conn -> real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (message, sender_id, receiver_id) VALUES ('$message','$senderid', '$receiverid')";

    if(mysqli_query($conn, $sql)){
        $_SESSION['messagesent'] = TRUE;
        if (isset($_GET['chat'])) {
            header("Location: messages.php?sender=' . $senderid . '&chat=1");
        }else{
        header("Location: messages.php?sender=' . $senderid . '");
        }
        exit();
    }else{
        session_start();
        $_SESSION['sqlerror'] = TRUE;
        header("Location: index.php?error=sqlerror");
        exit();
    } 
    mysqli_close($conn);
?>