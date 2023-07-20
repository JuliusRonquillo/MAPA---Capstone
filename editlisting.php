<?php 
    require_once "phpsession.php";
    require 'connection.php';

    if(isset($_SESSION['invalidphonenumber'])){
        if ($_SESSION['invalidphonenumber'] == TRUE){
            $_SESSION['invalidphonenumber'] = FALSE;
            echo "<script>alert('Invalid phone number.');</script>";
        }
    }
    if(isset($_SESSION['sqlerror'])){
        if ($_SESSION['sqlerror'] == TRUE){
            $_SESSION['sqlerror'] = FALSE;
            echo "<script>alert('Server error. Try again later.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS//addlisting.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
        <title>Edit Listing</title>
    </head>
    <body>
        <?php include "header.php"?>
        <div class="feed">
            <div class="main-block">
                <div class="left-part">
                    <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                        
                            $query = "SELECT * FROM `multiple-images` WHERE listingID='".$id."' LIMIT 1";
                            $queryRun = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($queryRun)){
                                $img = $row['image_name'];
                            }
                            echo '<img src="uploads//' . $img . '" class="leftpartimg">';

                            $query2 = "SELECT * FROM rentals WHERE id='".$id."'";
                            $query2Run = mysqli_query($conn, $query2);
                            while($row2 = mysqli_fetch_array($query2Run)){
                            echo '<a href="editlisting2.php?id=' . $id . '">Edit Images</a>'
                    ?>
                </div>
                <form action="editlistingphp.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="title">
                        <h3>Edit Rental Listing</h3>
                    </div>
                    <div class="info">
                        <div>
                            <label for="bldgname"><b>Building Name:</b></label>
                            <input type="text" name="bldgname" value=<?php echo $row2['building_name']; ?>>
                            <label for="gender"><b>For:</b></label>
                            <input type="text" size="10" list="gender" name="gender" value=<?php echo $row2['gender']; ?>>
                            <datalist id="gender">
                                <option value="Females Only">Females Only</option>
                                <option value="Males Only">Males Only</option>
                                <option value="Anyone">Anyone</option>
                            </datalist>
                        </div>
                        <label for="address"><b>Address:*</b></label>
                        <input type="text" name="address" value=<?php echo $row2['address']; ?> required>
                        <div>
                            <label for="lat"><b>Latitude:*</b></label>
                            <input type="number" name="lat" value=<?php echo $row2['latitude']; ?> class="locationad" required step="any">
                            <label for="long"><b>Longitude:*</b></label>
                            <input type="number" name="long" value=<?php echo $row2['longitude']; ?> class="locationad" required step="any">
                        </div>
                        <b>Rent*</b>
                        <div class="rent">
                            <input type="number" class="price" name="price" value=<?php echo $row2['rent_price']; ?> min="1" required>
                            <input type="text" size="10" list="rentcollection" name="rentcollection" value=<?php echo $row2['rental_collection']; ?>>
                            <datalist id="rentcollection">
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Annually">Annually</option>
                                <option value="6months">Every 6 months</option>
                                <option value="Other">Other</option>
                            </datalist>
                        </div>
                        
                        <div>
                            <label for="rental_type"><b>Rental Type:*</b></label>
                            <input type="text" list="rental_type" name="rental_type" value=<?php echo $row2['rental_type']; ?>/>
                            <datalist id="rental_type">
                                <option value="Apartment&emsp;Unit">Apartment Unit</option>
                                <option value="House">House</option>
                                <option value="Bedspacer">Bedspacer</option>
                                <option value="Condominium">Condominium</option>
                            </datalist>
                            <label for="floorarea"><b>Floor Area:</b></label>
                            <input type="text" name="floorarea" value=<?php echo $row2['floor_area'].'&emsp;sqm'; ?> size="10">
                        </div>
                        <div>
                            <label for="floors"><b>Floors:</b></label>
                            <input type="number" name="floors" value=<?php echo $row2['floors']; ?> min="1" max="99">
                            <label for="beds"><b>Beds:*</b></label>
                            <input type="number" name="beds" value=<?php echo $row2['beds']; ?> min="1" max="99" required>
                            <label for="baths"><b>Bathrooms:*</b></label>
                            <input type="number" name="baths" value=<?php echo $row2['baths']; ?> min="1" max="99" required>
                        </div>
                        <label for="details"><b>Additional Details:</b></label>
                        <textarea id="details" name="details" rows="3" cols="50"><?php echo $row2['details']; ?></textarea>
                        <label for="contact"><b>Contact Number:*</b></label>
                        <input type="text" name="contact" value=<?php echo $row2['contact_number']; ?> required>
                        <hr class="solid">
                        <?php
                            }}
                        ?>
                    </div>
                    <button type="submit" name="submit" class="addlistingbtn">Save</button>
                </form>
            </div>
        </div>
    </body>
    <?php 
    include "footer.php"?>
</html>