<?php
require 'connection.php';
require_once "phpsession.php";

$query = "SELECT * FROM rentals ORDER BY id DESC LIMIT 1";
$queryRun = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($queryRun)){
    $listingID = $row['id'];
}

if(isset($_POST['submit']))
{
	$extension=array('jpeg','jpg','png');
	foreach ($_FILES['image']['tmp_name'] as $key => $value) {
		$filename=$_FILES['image']['name'][$key];
		$filename_tmp=$_FILES['image']['tmp_name'][$key];
		$ext=pathinfo($filename,PATHINFO_EXTENSION);

		$finalimg='';
		if(in_array($ext,$extension))
		{
			if(!file_exists('uploads/'.$filename))
			{
			move_uploaded_file($filename_tmp, 'uploads/'.$filename);
			$finalimg=$filename;
			}else
			{
				 $filename=str_replace('.','-',basename($filename,$ext));
				 $newfilename=$filename.time().".".$ext;
				 move_uploaded_file($filename_tmp, 'uploads/'.$newfilename);
				 $finalimg=$newfilename;
			}
			//insert
			$insertqry="INSERT INTO `multiple-images`( `image_name`, `listingID`) VALUES ('$finalimg','$listingID')";
			mysqli_query($conn,$insertqry);

			header("Location: rentals.php?success=listingadded");
		}else
		{
			//display error
		}
	}
}
?>

