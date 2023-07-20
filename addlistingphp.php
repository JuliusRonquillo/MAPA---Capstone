<?php
    require 'connection.php';
    require_once "phpsession.php";
    $query = "SELECT * FROM accounts WHERE id={$_SESSION['sessionId']};";
    $queryRun = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($queryRun)){
        $username = $row['username'];
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
    $agree = $conn -> real_escape_string($_REQUEST['agree']);

    if (!preg_match("/^\d+$/", $contact)) {
        session_start();
        $_SESSION['invalidphonenumber'] = TRUE;
        header("Location: addlisting.php?error=invalidphonenumber");
        exit();
    }

    $sql = "INSERT INTO rentals (by_user, building_name, address, latitude, longitude, contact_number, floor_area, rental_type, rent_price, rental_collection, floors, beds, baths, details, gender) VALUES ('$username','$bldgname', '$address', '$lat', '$long', '$contact', '$floorarea', '$rental_type', '$price', '$rentcollection', '$floors', '$beds', '$baths', '$details', '$gender')";


    if(mysqli_query($conn, $sql)){
        header("Location: addlisting2.php?success=listingadded");
        exit();
    }else{
        session_start();
        $_SESSION['sqlerror'] = TRUE;
        header("Location: addlisting.php?error=sqlerror");
        exit();
    } 
    mysqli_close($conn);
    
?>