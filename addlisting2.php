<?php 
    require_once "phpsession.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS//addlisting.css">
        <link rel="stylesheet" href="CSS//footer.css">
        <link rel="stylesheet" href="CSS//header.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="icon" href="Assets//mapalogo.png" type="image/icon type">
        <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>
        <title>Add Rental Listing</title>
    </head>
    <body>
        <?php include "header.php"?>
        <div class="feed">
            <div class="main-block">
                <form method="post" enctype="multipart/form-data" action="upload.php">
                    <div class="title">
                        <h3>Add Rental Listing</h3>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image[]" class="form-control" multiple />
                    </div>
                    <input type="submit" name="submit" value="Submit" class="addlistingbtn">
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
    <?php include "footer.php"?>
</html>