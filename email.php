

<?php
session_start();
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
  header("location: mainindex.php");

}
require 'base.php';
require 'connect.php';

// if (isset($_POST) & !empty($_POST)) {
  // $email = mysqli_real_escape_string($connect,$_POST['email']);
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
  $count = mysqli_num_rows($result);
  if ($count ==1) {
  $r = mysqli_fetch_assoc($result);

}



?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/main.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Confirmation</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Confirmation</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
		<div class="container" style="width:80  %;">
            <div style="clear:both"></div>
             <br />
             <h3 id="1"><i>Order Details</i></h3>
            <div class="table-responsive">
                <table class="table table-bordered" style="border:10px;">
                       <tr>
                            <th width="10%">Item Id</th>
                            <th width="40%">Item Name</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Price</th>
                            <th width="15%">Total</th>
                            <th width="5%">Action</th>
                         
                       </tr>
                       <?php
                       if(!empty($_SESSION["shopping_cart"]))
                       {
                            $total = 0;
                            //new line
                                    $a = null;
                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                            {
                       ?>
                       <tr>
                         <?php //new linear
                         $b = $values["item_id"];
                           $a = $b.",".$a;
                          ?>
                           <td> <?php echo $values["item_id"]; ?> </td>
                            <td><?php echo $values["item_name"]; ?></td>
                            <td><?php echo $values["item_quantity"]; ?></td>
                            <td>Rs <?php echo $values["item_price"]; ?></td>
                            <td>RS <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                            <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                            <!-- <td> <select name="size">
                              <option value="s">S</option>
                              <option value="m">M</option>
                              <option value="xm">XM</option>
                              <option value="l">L</option>
                              <option value="xl">XL</option>
                            </select>
                            </td> -->
							
                       </tr>
                       <?php
                                 $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            }
                       ?>
                       <tr>
                            <td colspan="3" align="right">Total</td>
                            <td align="right">Rs. <?php echo number_format($total, 2); ?></td>
                            <td></td>
                       </tr>
                       <?php
                       }
                       ?>
                </table>
			</div>
		</div>
  <br>
  <br>
  <br>
  <br>

<h1 align="center">Address Details</h1>

 <form action="mail_handler.php" method="post" name="form" class="form-box">
	
			<label for="name">Name</label><br>
			<input type="text" name="name" class="inp" placeholder="Enter Your Name" value="<?php echo $r['name']; ?>"><br>
			<label for="email">Email ID</label><br>
			<input type="email" name="email" class="inp" placeholder="Enter Your Email"value="<?php echo $r['email']; ?>" ><br>
			<label for="iditem">Id Item</label><br>
			<input type="text" name="id" class="inp" placeholder="Enter id with quantity" value="<?php echo $a; ?>"required><br>
      <label for="size">size</label><br>
			
      <select name="size">
        <option>SELECT SIZE</option>
		<option value="xs">XS</option>
        <option value="s">S</option>
        <option value="m">M</option>
        <option value="l">L</option>
        <option value="xl">XL</option>
      </select>
			<label for="address">Address</label><br>
		<input type="text" name="msg" class="msg-box" placeholder="Enter id with size" value="<?php echo $r['address']; ?>"/><br>
	  <br>
		<input type="submit" name="submit" value="Send" class="primary-btn">
	</form>
	<center>
	<input type="checkbox" disabled="disabled" checked="checked">Cash on Delivery(COD)</input>
    </center>
  </body>
</html>
