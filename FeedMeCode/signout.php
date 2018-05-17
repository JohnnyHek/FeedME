<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/05/2018
 * Time: 13:34
 */
session_start();
session_destroy();
//unset($_SESSION['userID']);
echo "<script type='text/javascript'>alert('Sign out successfully.');window.location.href='index.php';</script>";
?>