
<?php

//logout.php
session_start(); 
session_unset();
session_destroy(); 
header('location: /dingofood/ApplicationLayer/ManageAdminInterface/adminLogin.php');
exit();
?>
