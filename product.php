<?php
session_start();
include 'base.php';
require_once 'connect.php';

if (isset($_SESSION['email'])){

    header("Location: index.php");
	}
else {
	header("Location: userlogin.php");

  }
 ?>