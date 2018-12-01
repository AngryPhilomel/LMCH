<?php
session_start();
require "config.php";
if(isset($_GET['id']) & is_numeric($_GET['id']))
{
  $id = $_GET['id'];
  $query7 = mysqli_query($db , "DELETE FROM `commonmessages` WHERE `id` = $id");
}
header("Location:".$site_url);
?>
