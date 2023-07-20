<?php 
    require_once "phpsession.php";

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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>
        <title>Add Rental Listing</title>
    </head>
    <body>
        <?php include "header.php"?>
        <div class="feed">
            <div class="main-block">
                <div class="left-part">
                    <img src="Assets/apartment.jpg" alt="Apartment Interior" class="leftpartimg">
                </div>
                <form action="addlistingphp.php" method="post" enctype="multipart/form-data">
                    <div class="title">
                        <h3>Add Rental Listing</h3>
                    </div>
                    <div class="info">
                        <div>
                            <label for="bldgname"><b>Building Name:</b></label>
                            <input type="text" name="bldgname" placeholder="Building Name">
                            <label for="gender"><b>For:</b></label>
                            <select name="gender" value="gender" class="gender" id="gender">
                                    <option value="Females Only">Females Only</option>
                                    <option value="Males Only">Males Only</option>
                                    <option value="Anyone" selected>Anyone</option>
                            </select>
                        </div>
                        <label for="address"><b>Address:*</b></label>
                        <input type="text" name="address" placeholder="Address" required>
                        <div>
                            <label for="lat"><b>Latitude:*</b></label>
                            <input type="number" name="lat" placeholder="Latitude" class="locationad" required step="any">
                            <label for="long"><b>Longitude:*</b></label>
                            <input type="number" name="long" placeholder="Longitude" class="locationad" required step="any">
                        </div>
                        <b>Rent*</b>
                        <div class="rent">
                            <input type="number" class="price" name="price" placeholder="Price" min="1" required>
                            <select name="rentcollection" class="rentcollection" value="rentcollection" id="rentcollection">
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly" selected>Monthly</option>
                                <option value="Annually">Annually</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="rental_type"><b>Rental Type:*</b></label>
                            <input type="text" list="rental_type" name="rental_type"/>
                            <datalist id="rental_type">
                                <option value="Apartment Unit">Apartment Unit</option>
                                <option value="House">House</option>
                                <option value="Bedspacer">Bedspacer</option>
                                <option value="Condominium">Condominium</option>
                            </datalist>
                            <label for="floorarea"><b>Floor Area:</b></label>
                            <input type="text" name="floorarea" placeholder="sqm" size="10">
                        </div>
                        <div>
                            <label for="floors"><b>Floors:*</b></label>
                            <input type="number" name="floors" placeholder="Floors" min="1" max="99" required>
                            <label for="beds"><b>Beds:*</b></label>
                            <input type="number" name="beds" placeholder="Beds" min="1" max="99" required>
                            <label for="baths"><b>Bathrooms:*</b></label>
                            <input type="number" name="baths" placeholder="Baths" min="1" max="99" required>
                        </div>
                        <label for="details"><b>Additional Details:</b></label>
                        <textarea id="details" name="details"  rows="3" cols="50" placeholder="Additional Details"></textarea>
                        <label for="contact"><b>Contact Number:*</b></label>
                        <input type="text" name="contact" placeholder="Contact number" required>
                        <hr class="solid">

                        <div class="checkbox">
                            <input type="checkbox"  name="agree" required><span>I agree to the <a href="">Privacy Policy for MAPA.</a>*</span>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="addlistingbtn">Next</button>
                </form>
            </div>
        </div>
    </body>
    <?php include "footer.php"?>
</html>