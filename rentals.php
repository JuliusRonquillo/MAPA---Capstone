<?php 
    require_once "phpsession.php";
    require 'connection.php';
    if(isset($_SESSION['listingdeleted'])){
        if ($_SESSION['listingdeleted'] == TRUE){
            $_SESSION['listingdeleted'] = FALSE;
            echo "<script>alert('Listing successfully deleted.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS//rentals.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
        <title>My Rental Listings</title>
    </head>
    <body>
        <?php include "header.php"?>
        <div class="rentals">
            <table class="listings">
                <tr>
                    <td colspan="2"><p class="title">My Rentals</p><br></td>
                    <td class="addlisting"><a href='addlisting.php' class='addlistingbtn'>Add listing</a></td>
                </tr>
                <?php
                    $pesosign = '&#8369;';

                    $query = "SELECT * FROM accounts WHERE id={$_SESSION['sessionId']};";
                    $queryRun = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($queryRun)){
                        $username = $row['username'];
                    }

                    $query2 = "SELECT * FROM rentals WHERE by_user='".$username."'";
                    $query2Run = mysqli_query($conn, $query2);

                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "true"){
                            $id = $_GET['id'];
                            $sql = "DELETE FROM rentals WHERE id='".$id."'";
                            
                            $sql3 = "SELECT * FROM `multiple-images` WHERE listingID='".$id."'";
                            $sql3Run = mysqli_query($conn, $sql3);
                            while($imgs = mysqli_fetch_array($sql3Run)){
                                $img = 'uploads/'.$imgs['image_name'];
                                unlink($img);
                            }
                            $sql2 = "DELETE FROM `multiple-images` WHERE listingID='".$id."'";
                            if ($conn->query($sql) === TRUE && $conn->query($sql2) && $conn->query($sql3)) {
                                session_start();
                                $_SESSION['listingdeleted'] = TRUE;
                                header("Location: rentals.php?listingdeleted");
                                exit();
                              } else {
                                header("Location: rentals.php?error=sqlerror");
                              }
                            
                        }else {
                        }
                    }

                    while($row2 = mysqli_fetch_array($query2Run)){
                        $listingID = $row2['id'];
                        $query3 = "SELECT * FROM `multiple-images` WHERE listingID='".$listingID."' LIMIT 1";
                        $query3Run = mysqli_query($conn, $query3);
                        while($row3 = mysqli_fetch_array($query3Run)){
                            $img = $row3['image_name'];
                        }
                        echo
                        '<tr class="trlisting">
                            <td class="tdimg">
                                <img src="uploads//' . $img . '" class="listingimg">
                            </td>
                            <td class="details">
                                <h1>' . $row2['building_name'] . '</h1><br>
                                <h2>' . $row2['rental_type'] . '</h2>
                                <h2>'. $pesosign . $row2['rent_price'] . '/' . $row2['rental_collection'] . '</h2>
                                <h3>' . $row2['address'] . '</h3>
                            </td>
                            <td class="end">
                                <a href="editlisting.php?id=' . $listingID . '" class="addlistingbtn">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Edit Listing
                                </a><br><br><br>
                                <a href="?delete=true&id=' . $listingID . '" class="addlistingbtn" onclick="return confirm(';
                        echo
                            "'Are you sure you want to delete this listing?');";
                        echo
                            '">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Delete Listing
                                </a>
                            </td>
                        </tr>';
                    }
                ?>
            </table>
            
        </div>
    </body>
    <?php include "footer.php"?>
</html>