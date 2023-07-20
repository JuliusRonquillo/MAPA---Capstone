<?php 
    require_once "phpsession.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS//index.css">
    <link rel="stylesheet" href="CSS//listing.css">
    <link rel="stylesheet" href="CSS//footer.css">
    <link rel="stylesheet" href="CSS//header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap" rel="stylesheet">
    <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script onload="mapContent();" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"
        defer></script>
    <title>Rental Listing Info</title>
</head>

<body>
    <?php include "header.php"?>
    <div class="feed">
        <div class="listingphotos">
            <?php 
                if (isset($_GET['id']) && isset($_GET['poster']) ) {
                    $id = $_GET['id'];
                    $poster = $_GET['poster'];
                    $name =  $_GET['poster'];

                    $query = "SELECT * FROM users WHERE username='".$poster."'";
                    $queryRun = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($queryRun)){
                        $name = $row['username'];
                    }
                }
                $imgquery = "SELECT *,r.id as id FROM rentals r INNER JOIN rental_img i ON r.id = i.rid WHERE r.id ='".$id."' LIMIT 1";
                $imgqueryRun = mysqli_query($conn, $imgquery);
                while($rowimg = mysqli_fetch_array($imgqueryRun)){
                    $img = $rowimg['photo'];
                    if ($img) {
                        echo '<img src="main/public/assets/images/apartment/' . $img . '" class="photos">';
                    }
                }
                ?>
        </div>
        <table class="info">
            <tr>
                <?php 
                    $query2 = "SELECT * FROM rentals WHERE id='".$id."'";
                    $query2Run = mysqli_query($conn, $query2);
                    while($row2 = mysqli_fetch_array($query2Run)){
                        $lat = $row2['latitude'];
                        $lon = $row2['longitude'];
                        $type = $row2['rental_type'];
                        
                    echo 
                    '<td>
                        <h2>' . $row2['building_name'] . '</h2>
                        <h1>' . $row2['rental_type'] . '</h1>
                        <h2>' . $row2['rent_price'] . '/' . $row2['rental_collection'] . '</h2>
                        <br>
                        Address:
                        <h2>' . $row2['address'] . '</h2>
                        <br>
                        <h3>For ' . $row2['gender'] . '</h3>
                        <br>';
                        if ($row2["floor_area"] > 0){
                            echo 'Floor Area: <h3>' . $row2['floor_area'] . ' sqm</h3>';
                        }
                    echo 
                        '<br>
                        Beds: <b>' . $row2['beds'] . '</b>
                        Baths: <b>' . $row2['baths'] . '</b>
                    </td>
                    <td>
                        <h3>Posted by:</h3>
                        <h2>' . $name . '</h2><br>';
                    if (isset($_SESSION['sessionId'])) {
                        $usersql = "SELECT * FROM users WHERE id={$_SESSION['sessionId']};";
                        $usersqlRun = mysqli_query($conn, $usersql);
                        while($rowuser = mysqli_fetch_array($usersqlRun)){
                            $userid = $rowuser['id'];
                        }
                        echo 
                        '<div id="chatDiv" style="display:none;">
                            <form action="sendmessage.php?sender=' . $userid . '&receiver=' . $poster . '" method="post">
                                <label for="message"><b>Send message to ' . $name . '</b></label>
                                <textarea placeholder="Type message.." name="message" required></textarea>

                                <button type="submit" class="addlistingbtn">Send</button>
                                <input type="button" name="close" class="addlistingbtn" value="Close" onclick="closeChat()" />
                            </form>
                        </div>
                        <input type="button" name="" class="addlistingbtn" value="Send Message" onclick="showChat()" />';
                    }
                    echo
                        '<br><br><br>
                        <h3>Contact Number:</h3>
                        <h2>' . $row2['contact_number'] . '</h2>
                        </td>';
                    ?>
            </tr>
        </table>
        <div id='map' style="height: 500px; width: 100%;"></div>
    </div>

    <script>
    function showChat() {
        document.getElementById('chatDiv').style.display = "block";
    }

    function closeChat() {
        document.getElementById('chatDiv').style.display = "none";
    }

    function mapContent() {
        var api_key = 'H92PtTd3hxV15Gp57sWxWJUgtnGeTwzG';
        var latitude = <?php echo $lat; ?>;
        var longitude = <?php echo $lon; ?>;
        var latAndLong = {
            lat: latitude,
            lng: longitude
        };
        var zoomLevel = 14;

        var map = tt.map({
            container: 'map',
            key: api_key,
            center: latAndLong,
            zoom: zoomLevel
        });

        var marker = new tt.Marker().setLngLat(latAndLong).addTo(map);

        var popupOffsets = {
            top: [0, 0],
            bottom: [0, -70],
            'bottom-right': [0, -70],
            'bottom-left': [0, -70],
            left: [25, -35],
            right: [-25, -35]
        }

        var popup = new tt.Popup({
            offset: popupOffsets
        }).setHTML(yourAddress);
        marker.setPopup(popup).togglePopup();

    }
    </script>
    <?php } ?>
</body>
<?php include "footer.php"?>

</html>