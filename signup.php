<?php 
    require_once "phpsession.php";
    require_once "register.php";
    if(isset($_SESSION['notype'])){
        if ($_SESSION['notype'] == TRUE){
            $_SESSION['notype'] = FALSE;
            echo "<script>alert('Please select account type.');</script>";
        }
    }
    if(isset($_SESSION['invalidusername'])){
        if ($_SESSION['invalidusername'] == TRUE){
            $_SESSION['invalidusername'] = FALSE;
            echo "<script>alert('Invalid Username');</script>";
        }
    }
    if(isset($_SESSION['invalidname'])){
        if ($_SESSION['invalidname'] == TRUE){
            $_SESSION['invalidname'] = FALSE;
            echo "<script>alert('Invalid Name');</script>";
        }
    }
    if(isset($_SESSION['invalidphonenumber'])){
        if ($_SESSION['invalidphonenumber'] == TRUE){
            $_SESSION['invalidphonenumber'] = FALSE;
            echo "<script>alert('Invalid Phone Number');</script>";
        }
    }
    if(isset($_SESSION['passwordsdonotmatch'])){
        if ($_SESSION['passwordsdonotmatch'] == TRUE){
            $_SESSION['passwordsdonotmatch'] = FALSE;
            echo "<script>alert('Passwords do not match');</script>";
        }
    }
    if(isset($_SESSION['sqlerror'])){
        if ($_SESSION['sqlerror'] == TRUE){
            $_SESSION['sqlerror'] = FALSE;
            echo "<script>alert('Database Error');</script>";
        }
    }
    if(isset($_SESSION['usernametaken'])){
        if ($_SESSION['usernametaken'] == TRUE){
            $_SESSION['usernametaken'] = FALSE;
            echo "<script>alert('Username taken');</script>";
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="CSS//login.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <title>
            E-WAYS | Registration
        </title>
    </head>
    <body>
        <?php include "header.php" ?>
        
        <div class="formdiv">
            <table>
                <tr>
                    <td>
                        <h1>Rent out a space.</h1>
                    </td>
                    <td>
                        <div class="Form">
                            <p>Create An Account</p>
                            <form action="register.php" method="post">
                                I am a <br>
                                    <input type="radio" id="tenant" name="type" value="tenant">
                                    <label for="tenant">Prospective Tenant</label><br>
                                    <input type="radio" id="landlord" name="type" value="landlord">
                                    <label for="landlord">Landlord</label><br><br>
                                Name <br>
                                <input type="text" id="name" name="name" placeholder="Please enter your name here" size="50" required><br>
                                Username <br>
                                <input type="text" id="username" name="username" placeholder="Please enter your username" size="50" required><br>
                                Email<br>
                                <input type="email" id="email" name="email" placeholder="Please enter your email" size="50" required><br>
                                Password <br>
                                <input type="password" id="password" name="password" placeholder="Minimum of 8 characters" size="50" required><br>
                                Confirm Password <br>
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your Password" size="50" required><br>
                                Phone Number <br>
                                <input type="phone" id="phone" name="phone" placeholder="09xx xxx xxxx" size="50" required><br><br>
                                <button type="submit" name="submit" class="loginbtn" style="margin-left: 30%; font-size: 30px; margin-bottom: 2%;">Sign up</button><br>
                                <p style="text-align: left; font-size: 25px">Already have an account? <a href="login.php">Log in here</a> </p>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    <?php include "footer.php"?>
</html>