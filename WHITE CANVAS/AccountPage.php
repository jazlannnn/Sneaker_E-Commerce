<?php
   include "config.php";

    if (isset($_POST["Update_Button"])) {
        if (isset($_SESSION['user_id'])) {
            $username = $_POST["Username"];
            $password = $_POST["Password"]; 
            $Email = $_POST["Email"];
            $PhoneNumber = $_POST["PhoneNumber"];
            $Address = $_POST["Address"];

            $sql = "UPDATE customer 
                    SET Customer_Username = :username, Customer_Password = :password, Customer_Email = :email,
                        Customer_PhoneNumber = :phoneNumber, Customer_Address = :address
                    WHERE Customer_ID = :userID";

            $sendsql = oci_parse($dbconn, $sql);
            oci_bind_by_name($sendsql, ':username', $username);
            oci_bind_by_name($sendsql, ':password', $password);
            oci_bind_by_name($sendsql, ':email', $Email);
            oci_bind_by_name($sendsql, ':phoneNumber', $PhoneNumber);
            oci_bind_by_name($sendsql, ':address', $Address);
            oci_bind_by_name($sendsql, ':userID', $_SESSION['user_id']);
            oci_execute($sendsql);

            if ($sendsql) {    
                echo "<script>alert('Update complete')</script>";
            } else {
                echo "<script>alert('Update failed')</script>";
            }
        } else {
            echo "<script>alert('You must Login First')</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            White Canvas | My Account</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="CSS/AccountPage.css" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    </head>

    <body>
        <!--------------------- Header (calling header function)-------------------->
        <div id="header"></div>
        <!--------------------- Header End -------------------->

        <!--------------------- content -------------------->

        <div style="height:800px; display:flex; width:100%">
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <a href="AccountPage.php">Account</a>
                <a href="CartPage.php">My Cart</a>
                <a href="OrderHistory.php">My purchase</a>
                <a href="Logout.php">Logout</a>
            </div>

            <div class="main">

                <button class="openbtnX" onclick="openNav()">☰ Open Sidebar</button>

                <h1 style="text-align:center; font-size: 40px; ">My Account</h1>
                <hr>

                <div class="InnerContainer">

                    <div
                        style="width:30%; background-color:#DBE2EF; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <img src="Images/Image for users/AccountDetail.png" style="width:100%; "/>
                    </div>

                    <!--------------------- user info -------------------->
                    <div class="RegisterDiv">
                        <br>
                        <h2 >My Details</h2>
                        <hr style="width:100%">

                    <?php
                        if (isset($_SESSION['user_id'])) {
                            $query = "SELECT *
          FROM customer
          WHERE Customer_ID = :user_id";
$stmt = oci_parse($dbconn, $query);
oci_bind_by_name($stmt, ':user_id', $_SESSION['user_id']);
oci_execute($stmt);

$row = oci_fetch_assoc($stmt);
if ($row) {
    echo "<ol class='listStyle'>
            <li><b>Username     :</b> " . $row['CUSTOMER_USERNAME'] . "</li>
            <li><b>Password     :</b> " . $row['CUSTOMER_PASSWORD'] . "</li>
            <li><b>Email        :</b> " . $row['CUSTOMER_EMAIL'] . "</li>
            <li><b>Phone num.   :</b> " . $row['CUSTOMER_PHONENUMBER'] . "</li>
            <li><b>Address      :</b> " . $row['CUSTOMER_ADDRESS'] . "</li>
          </ol>";

    $Uname = $row['CUSTOMER_USERNAME'];
    $Upassword = $row['CUSTOMER_PASSWORD'];
    $Uemail = $row['CUSTOMER_EMAIL'];
    $UphoneNum = $row['CUSTOMER_PHONENUMBER'];
    $Uaddress = $row['CUSTOMER_ADDRESS'];
} else {
    echo "No user found.";
}

oci_free_statement($stmt); // Free the statement after use

                        } else {    
                            $Uname = 'None';    
                            $Upassword = '';    
                            $Uemail = 'None';    
                            $UphoneNum = 'None';    
                            $Uaddress = 'None';
                            echo "
                            <div style='text-align:center'>
                                <h3 style='color:grey;'>You must log in first, click the link below to login</h3>
                                <a style='text-decoration:none' href='LoginPage.php'> - Login here -</a>
                            </div>";
                        }
                    ?>
                        

                        <br><br><hr style=" color:gray; background-color:gray; width:100%">
                        <div style="text-align:center;">
                            <button
                                onclick="document.getElementById('id01').style.display='block'"
                                class="edit">Update account</button>
                        </div>

                        <!--------------------- update form -------------------->
                        <div id="id01" class="modal">
                            <span
                                onclick="document.getElementById('id01').style.display='none'"
                                class="close"
                                title="Close Modal">&times;</span>
                            <div style="margin-left: auto; margin-right: auto; text-align:center;">
                                <form class="modal-content" action="AccountPage.php" method="post">
                                    <div class="containers">
                                        <h1>Update your account</h1>
                                        <p>Please fill in the specific detail to update your account.</p```php
                                        <hr>

                                        <div style="display:block; margin-bottom: 10px;  text-align:center; ">
                                            <input
                                                class="input-field1"
                                                type="text"
                                                placeholder="<?php echo "$Uname";?>"
                                                name="Username"
                                                value="<?php echo "$Uname";?>">

                                            <input
                                                class="input-field1"
                                                type="password"
                                                placeholder="<?php echo "$Upassword";?>"
                                                name="Password"
                                                value="<?php echo "$Upassword";?>">

                                            <input
                                                class="input-field1"
                                                type="text"
                                                placeholder="<?php echo "$Uemail";?>"
                                                name="Email"
                                                value="<?php echo "$Uemail";?>">

                                            <input
                                                class="input-field1"
                                                type="text"
                                                placeholder="<?php echo "$UphoneNum";?>"
                                                name="PhoneNumber"
                                                value="<?php echo "$UphoneNum";?>">

                                            <input
                                                class="input-field1"
                                                type="text"
                                                placeholder="<?php echo "$Uaddress";?>"
                                                name="Address"
                                                value="<?php echo "$Uaddress";?>">
                                        </div>

                                        <div class="clearfix">
                                            <button
                                                type="button"
                                                onclick="document.getElementById('id01').style.display='none'"
                                                class="cancelbtn">Cancel</button>
                                            <button type="submit" class="updatebtn" name="Update_Button">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------------------- content end -------------------->

        <!--------------- Footer ---------------->
        <div id="footer"></div>
        <!--------------- End of footer---------------->

        <script>
            /*-------------------------- Sidebar ------------------------------*/
            function openNav() {
                document
                    .getElementById("mySidebar")
                    .style
                    .width = "20%";
                document
                    .getElementById("main")
                    .style
                    .marginLeft = "50px";
            }

            function closeNav() {
                document
                    .getElementById("mySidebar")
                    .style
                    .width = "0";
                document
                    .getElementById("main")
                    .style
                    .marginLeft = "0";
            }
            /*-------------------------- Sidebar ends ------------------------------*/

            /* -------------------------- Calling header and footer fucntion
 * ------------------------------
 */
            $(function () {
                $("#header").load("Header.php");
                $("#footer").load("Footer.php");
            });
            /* -------------------------- header and footer fucntion end
 * ------------------------------
 */

            /* -------------------------- header and footer fucntion end
 * ------------------------------
 */
            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            /* -------------------------- header and footer fucntion end
 * ------------------------------
 */
        </script>

    </body>
</html>
