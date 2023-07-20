<?php 
    require_once "phpsession.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS//index.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap" rel="stylesheet">
        <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js">
    </script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
        type="text/css">
        <title>Home Page</title>
        <style>

    #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }
    

    .marker {
        background-image: url('assets/images/mark.gif');
        background-size: contain;
        object-fit: contain;
        width: 64px;
        height: 64px;
        border-radius: 100%;
        background-position: center;
        background-color: transparent;
        ;
        background-repeat: no-repeat;
        cursor: pointer;
    }

    .mapboxgl-popup {
        width: 500px;
    }

    .mapboxgl-popup-content {
        text-align: left;
        font-family: "Poppins", sans-serif;
        font-size: 12px;
    }
    </style>
    </head>
    <body>
        <?php include "header.php"?>
        <div class="feed">
            <div>
                <img src="Assets//house.png" alt="Home Page Image" class="homeimg">
            </div>
            <div>
                <p class="overlaptext">Find your Home.<br>We'll help you MAP it out.</p>
            </div> 
            <div>
                <p class="title">Rentals</p>
            </div>
            <div class="rentals">
            <form action="search.php" method="post">
                <div class="search_box">
                    <input type="text" placeholder="Search rentals..." name="search" class="searchbar" required>
                    <div class="searchbtns">
                        <select name="filter" class="search_btn" value="filter" id="filter">
                            <option value="location">Location</option>
                            <option value="rental type">Rental Type</option>
                            <option value="beds">Beds</option>
                            <option value="price under">Price under</option>
                        </select>
                        <button type="submit" name="submit" class="search_btn" style="width: 55px;"><i class="fa fa-search"></i></button> 
                    </div>
                </div>
            </form>
           
            <table class="listings">
                <?php
                    $pesosign = '&#8369;';

                    $query2 = "SELECT *,r.id as id FROM rentals r INNER JOIN rental_img i ON r.id = i.rid";
                    $query2Run = mysqli_query($conn, $query2);

                    while($row2 = mysqli_fetch_array($query2Run)){
                        $listingID = $row2['id'];
                        $poster = $row2['by_user'];
                        $img = $row2['photo'];
                        $name = $row2['by_user'];

                     
                        echo
                        '<tr class="trlisting">
                            <td class="tdimg">
                                <img src="main/public/assets/images/apartment/' . $img . '" class="listingimg">
                            </td>
                            <td class="details">
                                <h1>' . $row2['building_name'] . '</h1>
                                <h2>' . $row2['rental_type'] . '</h2>
                                <h2>'. $pesosign . $row2['rent_price'] . '/' . $row2['rental_collection'] . '</h2>
                                <h3>' . $row2['address'] . '</h3>
                            </td>
                            <td class="end">
                                <h3>Posted by:</h3>
                                <h2>' . $name . '</h2><br>
                                <a href="listing.php?id=' . $listingID . '&poster=' . $name . '" class="addlistingbtn">More Info</a>
                            </td>
                        </tr>';
                    }
                ?>
            </table>
            
        </div>
        </div>
        
    </body>
    <?php include "footer.php"?>
</html>