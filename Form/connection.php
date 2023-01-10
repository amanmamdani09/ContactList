<?php
error_reporting(error_reporting() & ~E_NOTICE);
error_reporting(error_reporting() & ~E_WARNING);
$con = mysqli_connect("localhost", "admin", "Admin@123", "contact_list");
?>