<?php

if (isset($_POST['submit'])){
    require 'connection.php';

    $type = $_POST['type'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpass = $_POST['confirmPassword'];
    $phone = $_POST['phone'];

    if(!$type){
        session_start();
        $_SESSION['notype'] = TRUE;
        header("Location: signup.php?error=noaccounttype");
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        session_start();
        $_SESSION['invalidusername'] = TRUE;
        header("Location: signup.php?error=invalidusername");
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        session_start();
        $_SESSION['invalidname'] = TRUE;
        header("Location: signup.php?error=invalidname");
        exit();
    }
    elseif (!preg_match("/^\d+$/", $phone)) {
        session_start();
        $_SESSION['invalidphonenumber'] = TRUE;
        header("Location: signup.php?error=invalidphonenumber");
        exit();
    }
    elseif (strlen($phone) != 11) {
        session_start();
        $_SESSION['invalidphonenumber'] = TRUE;
        header("Location: signup.php?error=invalidphonenumber");
        exit();
    }
    elseif ($password !== $confirmpass){
        session_start();
        $_SESSION['passwordsdonotmatch'] = TRUE;
        header("Location: signup.php?error=passwordsdonotmatch");
        exit();
    }
    else {
        $sql = "SELECT username FROM accounts WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            session_start();
            $_SESSION['sqlerror'] = TRUE;
            header("Location: signup.php?error=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if ($rowCount > 0){
                session_start();
                $_SESSION['usernametaken'] = TRUE;
                header("Location: signup.php?error=usernametaken");
                exit();
            }
            else {
                $sql = "INSERT INTO accounts (name, username, email, password, phone, type) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)){
                    session_start();
                    $_SESSION['sqlerror'] = TRUE;
                    header("Location: signup.php?error=sqlerror2");
                    exit();
                } 
                else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssssss", $name, $username, $email, $hashedPass, $phone, $type);
                    mysqli_stmt_execute($stmt);
                    session_start();
                    $_SESSION['registered'] = TRUE;
                    header("Location: login.php?success=registered");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>