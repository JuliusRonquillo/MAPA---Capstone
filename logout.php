<?php
    session_start();
    $_SESSION['loggedoutalert'] = TRUE;
    unset($_SESSION['sessionId']);
    header("Location: index.php?success=loggedout");
    exit();
?>