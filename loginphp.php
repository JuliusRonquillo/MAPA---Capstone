<?php

if (isset($_POST['submit'])){
    require 'connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)){
        session_start();
        $_SESSION['emptyfields'] = TRUE;
        header("Location: login.php?error=emptyfields");
        exit();
    } 
    else {
        $sql = "SELECT * FROM accounts WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            session_start();
            $_SESSION['sqlerror1'] = TRUE;
            header("Location: login.php?error=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)){
                $passCheck = password_verify($password, $row['password']);

                if ($passCheck == false) {
                    session_start();
                    $_SESSION['wrongpassword'] = TRUE;
                    header("Location: login.php?error=wrongpassword");
                    exit();
                }
                elseif($passCheck == true){
                    session_start();
                    $_SESSION['sessionId'] = $row['id'];
                    $_SESSION['sessionUser'] = $row['username'];
                    $_SESSION['loggedinalert'] = TRUE;
                    header("Location: profile.php?success=loggedin");
                    exit();
                } 
                else {
                    session_start();
                    $_SESSION['nouser'] = TRUE;
                    header("Location: login.php?error=nouser");
                    exit();
                }

            } 
            else {
                header("Location: login.php?error=nouser");
                exit();
            }
        }
    }
}
else{
    session_start();
    $_SESSION['accessforbidden'] = TRUE;
    header("Location: login.php?error=accessforbidden");
        exit();
}

?>