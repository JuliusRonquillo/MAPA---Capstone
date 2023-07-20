<div class="header">
    <img src="Assets/logowithname.png" alt="Logo" class="logo">
    <div>
        <table class="navtable">
            <tr>
                <td>
                    <div class="navbar">
                        <?php 
                        require "connection.php";
                        if (isset($_SESSION['sessionId'])){
                            if ($_SESSION['loggedinalert'] == TRUE){
                                $_SESSION['loggedinalert'] = FALSE;
                                echo "<script>alert('Successfully Logged in.');</script>";
                            }
                            $query = "SELECT * FROM accounts WHERE id={$_SESSION['sessionId']};";
                            $queryRun = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($queryRun)){
                                $username = $row['username'];
                                $type = $row['type'];
                                $id = $row['id'];
                            }
                            if ($type == "tenant") {
                                echo    
                                "<a href='index.php' class='navbutton'>Home</a>
                                <a href='profile.php?id=' . $id . ' class='navbutton'>My Profile</a>
                                <a href='messages.php?sender=' . $id . ' class='navbutton'>Messages</a>";
                                
                            }elseif($type == "landlord"){
                                echo    
                                    "<a href='rentals.php' class='navbutton'>My Rentals</a>
                                    <a href='profile.php?id=' . $id . ' class='navbutton'>My Profile</a>
                                    <a href='messages.php?sender=' . $id . ' class='navbutton'>Messages</a>";
                            }
                        }else {
                            if(isset($_SESSION['loggedoutalert'])){
                                if($_SESSION['loggedoutalert'] == TRUE){
                                    $_SESSION['loggedoutalert'] = FALSE;
                                    echo "<script>alert('Successfully Logged out.');</script>";
                                }
                            }
                            echo 
                                "<a href='index.php' class='navbutton'>Home</a>
                                <a href='main' class='navbutton'>Login</a>
                                <a href='main/home/register' class='navbutton'>Sign Up</a>";
                        }
                    ?>
                    </div>
                </td>
                
            </tr>
        </table>
    </div>
</div>