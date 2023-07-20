<?php
    require 'connection.php';
    require_once "phpsession.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $bldgname = $conn -> real_escape_string($_REQUEST['bldgname']);
    $address = $conn -> real_escape_string($_REQUEST['address']);
    $lat = $conn -> real_escape_string($_REQUEST['lat']);
    $long = $conn -> real_escape_string($_REQUEST['long']);
    $contact = $conn -> real_escape_string($_REQUEST['contact']);
    $floorarea = $conn -> real_escape_string($_REQUEST['floorarea']);
    $rental_type = $conn -> real_escape_string($_REQUEST['rental_type']);
    $price = $conn -> real_escape_string($_REQUEST['price']);
    $rentcollection = $conn -> real_escape_string($_REQUEST['rentcollection']);
    $floors = $conn -> real_escape_string($_REQUEST['floors']);
    $beds = $conn -> real_escape_string($_REQUEST['beds']);
    $baths = $conn -> real_escape_string($_REQUEST['baths']);
    $details = $conn -> real_escape_string($_REQUEST['details']);
    $gender = $conn -> real_escape_string($_REQUEST['gender']);

    if (!preg_match("/^\d+$/", $contact)) {
        session_start();
        $_SESSION['invalidphonenumber'] = TRUE;
        header("Location: editlisting.php?error=invalidphonenumber");
        exit();
    }

    $sql = "UPDATE rentals SET building_name='$bldgname', address='$address', latitude='$lat', longitude='$long', contact_number='$contact', floor_area='$floorarea', rental_type='$rental_type', rent_price='$price', rental_collection='$rentcollection', floors='$floors', beds='$beds', baths='$baths', details='$details', gender='$gender' WHERE id='$id'";

    if(mysqli_query($conn, $sql)){
        header("Location: rentals.php?success=listingedited");
        exit();
    }else{
        session_start();
        $_SESSION['sqlerror'] = TRUE;
        header("Location: rentals.php?error=sqlerror");
        exit();
    } 
    mysqli_close($conn);
    
?>