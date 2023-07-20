<?php 
    require_once "phpsession.php";
    if(isset($_SESSION['registered'])){
        if ($_SESSION['registered'] == TRUE){
            $_SESSION['registered'] = FALSE;
            echo "<script>alert('Successfully Registered');</script>";
        }
    }
    if(isset($_SESSION['emptyfields'])){
        if ($_SESSION['emptyfields'] == TRUE){
            $_SESSION['emptyfields'] = FALSE;
            echo "<script>alert('Empty Fields. Please enter your login details.');</script>";
        }
    }
    if(isset($_SESSION['sqlerror1'])){
        if ($_SESSION['sqlerror1'] == TRUE){
            $_SESSION['sqlerror1'] = FALSE;
            echo "<script>alert('Server error. Try again later.');</script>";
        }
    }
    if(isset($_SESSION['wrongpassword'])){
        if ($_SESSION['wrongpassword'] == TRUE){
            $_SESSION['wrongpassword'] = FALSE;
            echo "<script>alert('Wrong password.');</script>";
        }
    }
    if(isset($_SESSION['nouser'])){
        if ($_SESSION['nouser'] == TRUE){
            $_SESSION['nouser'] = FALSE;
            echo "<script>alert('no existing user id.');</script>";
        }
    }
    if(isset($_SESSION['accessforbidden'])){
        if ($_SESSION['accessforbidden'] == TRUE){
            $_SESSION['accessforbidden'] = FALSE;
            echo "<script>alert('Access for bidden.');</script>";
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="CSS//login.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> 
        <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>
        Log in
        </title>
    </head>
    <body>
        <?php include "header.php" ?>
        <div class="formdiv">
            <table>
                <tr>
                    <td>
                        <h1>Ready to map it out?</h1>
                    </td>
                    <td>
                        <div class="Form">
                            <p>Sign in to your Account</p>
                            <form action="loginphp.php" method="post" >
                                Username<br>
                                <input type="text" id="username" name="username" placeholder="Enter Username" size="50"><br>
                                Password <br>
                                <input type="password" id="password" name="password" placeholder="Enter Password" size="50"><br>
                                <table width="500px">
                                    <tr>
                                        <td colspan="2" style="text-align: center; font-size: 25px; padding-top: 5%;">
                                            <button type='submit' name='submit' class="loginbtn">Log in</button><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center; padding-top: 5%;">
                                            Want to be a landlord too? <a href="signup.php">Sign up here</a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    <?php include "footer.php"?>
</html>