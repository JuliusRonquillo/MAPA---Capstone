<?php
    require 'connection.php';
    require_once "phpsession.php";

    $searchword = $conn -> real_escape_string($_POST['search']);
    $filter = $_POST['filter'];
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
        <title>Search Results</title>
    </head>
    <body>
        <?php include "header.php"?>
        <div class="feed">
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
              <tr>
                <td colspan="2">
                  <br><h3>Search results for <?php echo $filter; ?>:</h3>
                  <h2>"<?php echo $searchword; ?>"</h2><br>
                </td>
              </tr>
            <?php
                $pesosign = '&#8369;';
                switch ($filter) {
                    case "location":
                      $query2 = "SELECT *,(SELECT photo FROM rental_img WHERE rid = r.id LIMIT 1) photo FROM rentals r WHERE address LIKE '%{$searchword}%'";
                      $query2Run = mysqli_query($conn, $query2);
                      while($row2 = mysqli_fetch_array($query2Run)){
                        $listingID = $row2['id'];
                        $poster = $row2['by_user'];
                        $img = $row2['photo'];

                        $query3 = "SELECT *,r.id as id,i.photo FROM rentals r INNER JOIN rental_img i ON r.id = i.rid WHERE r.id ='".$listingID."' LIMIT 1";
                        $query3Run = mysqli_query($conn, $query3);

                        $query = "SELECT * FROM users WHERE username='".$poster."'";
                        $queryRun = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_array($queryRun)){
                            $name = $row['username'];
                        }
                
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
                      break;
                    case "rental type":
                      $query2 = "SELECT * FROM rentals WHERE rental_type LIKE '%{$searchword}%'";
                      $query2Run = mysqli_query($conn, $query2);
                      while($row2 = mysqli_fetch_array($query2Run)){
                        $listingID = $row2['id'];
                        $poster = $row2['by_user'];

                        $query3 = "SELECT * FROM `multiple-images` WHERE listingID='".$listingID."' LIMIT 1";
                        $query3Run = mysqli_query($conn, $query3);

                        $query = "SELECT * FROM accounts WHERE username='".$poster."'";
                        $queryRun = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_array($queryRun)){
                            $name = $row['name'];
                        }
                        while($row3 = mysqli_fetch_array($query3Run)){
                            $img = $row3['image_name'];
                        }
                        echo
                        '<tr class="trlisting">
                            <td class="tdimg">
                                <img src="uploads//' . $img . '" class="listingimg">
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
                      break;
                    case "beds":
                      $query2 = "SELECT * FROM rentals WHERE beds LIKE '%{$searchword}%'";
                      $query2Run = mysqli_query($conn, $query2);
                      while($row2 = mysqli_fetch_array($query2Run)){
                        $listingID = $row2['id'];
                        $poster = $row2['by_user'];

                        $query3 = "SELECT * FROM `multiple-images` WHERE listingID='".$listingID."' LIMIT 1";
                        $query3Run = mysqli_query($conn, $query3);

                        $query = "SELECT * FROM accounts WHERE username='".$poster."'";
                        $queryRun = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_array($queryRun)){
                            $name = $row['name'];
                        }
                        while($row3 = mysqli_fetch_array($query3Run)){
                            $img = $row3['image_name'];
                        }
                        echo
                        '<tr class="trlisting">
                            <td class="tdimg">
                                <img src="uploads//' . $img . '" class="listingimg">
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
                      break;
                    case "price under":
                      if (is_numeric($searchword)){
                        $intprice = (int)$searchword;
                        $query2 = "SELECT * FROM rentals WHERE rent_price<=$intprice";
                        $query2Run = mysqli_query($conn, $query2);
                        while($row2 = mysqli_fetch_array($query2Run)){
                        $listingID = $row2['id'];
                        $poster = $row2['by_user'];

                        $query3 = "SELECT * FROM `multiple-images` WHERE listingID='".$listingID."' LIMIT 1";
                        $query3Run = mysqli_query($conn, $query3);

                        $query = "SELECT * FROM accounts WHERE username='".$poster."'";
                        $queryRun = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_array($queryRun)){
                            $name = $row['name'];
                        }
                        while($row3 = mysqli_fetch_array($query3Run)){
                            $img = $row3['image_name'];
                        }
                        echo
                        '<tr class="trlisting">
                            <td class="tdimg">
                                <img src="uploads//' . $img . '" class="listingimg">
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
                    }
                      break;
                    default:
                      break;
                  }
            ?>
            </table>
            
        </div>
        </div>
        
    </body>
    <?php include "footer.php"?>
</html>
