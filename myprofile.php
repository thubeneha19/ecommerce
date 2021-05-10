<?php
session_start();
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
  header("location: mainindex.php");

}

require 'base.php';
require 'usernav.php';
require 'connect.php';

// if (isset($_POST) & !empty($_POST)) {
  // $email = mysqli_real_escape_string($connect,$_POST['email']);
   $email = $_SESSION['email'];
  $sql = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
  $count = mysqli_num_rows($result);
  if ($count ==1) {
  $r = mysqli_fetch_assoc($result);




?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
.card {
  margin-top: 100px!important;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  margin: auto;
  text-align: center;
  font-family: arial;
  height: 500px !important;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body id="prof">
<?php
include("usernav.php");
?>
<br><br><br>
<center>
<div class="card">
  <h2 style="text-align:center"> Profile Card</h2>

  <img src="images\main\profile.png" alt="Profile pic" style="width:250px; margin-left:135px;">
  <H1><?php echo $r['name'];   ?></H1>
  <p style="font-size: 20px;">   <?php echo $r['email']; ?>
    <p style="font-size: 20px;">   <?php echo $r['address']; ?>
	</p> <?php } ?>
    
		<div class="single-footer-widget">
			<p>Let us be social</p>
			
				<div class="footer-social ">
					<a href="https://www.facebook.com/Baba1990fashion"><i class="fa fa-facebook"></i></a>
					<a href="https://twitter.com/fashion?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fa fa-twitter"></i></a>
					<a href="https://www.instagram.com/babuclothing/?hl=en"><img src="img/instagram.png"  width="25 height="25"></img></a>	
				</div>
			
		</div>
	
</div>
</center>
</body>
</html>
