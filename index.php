
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css\index.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 

<?php
require 'base.php';
require 'usernav.php';
require 'connect.php';

session_start();
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
  header("location: mainindex.php");

}

$connect = mysqli_connect("localhost", "root", "", "firsttab");
if(isset($_POST["add_to_cart"]))
{
   if(isset($_SESSION["shopping_cart"]))
   {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
             $count = count($_SESSION["shopping_cart"]);
             $item_array = array(
                  'item_id'               =>     $_GET["id"],
                  'item_name'             =>     $_POST["hidden_name"],
                  'item_price'            =>     $_POST["hidden_price"],
                  'item_quantity'         =>     $_POST["quantity"]
             );
             $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
             echo '<script>alert("Item Already Added")</script>';
             echo '<script>window.location="index.php"</script>';
        }
   }
   else
   {
        $item_array = array(
             'item_id'               =>     $_GET["id"],
             'item_name'               =>     $_POST["hidden_name"],
             'item_price'          =>     $_POST["hidden_price"],
             'item_quantity'          =>     $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
   }
}
if(isset($_GET["action"]))
{
   if($_GET["action"] == "delete")
   {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
             if($values["item_id"] == $_GET["id"])
             {
                  unset($_SESSION["shopping_cart"][$keys]);
                  echo '<script>alert("Item Removed")</script>';
                  echo '<script>window.location="index.php"</script>';
             }
        }
   }
}
?>
<!DOCTYPE html>
<html>
<body>
      <br><br><br><br><br><br>
	  <br><br>
        <div class="container" style="width:83%;background-image:url('images/main/banner.jpg')">
			<div align="right">
			<br>
				<button  class="primary-btn" >
				<a  href="#1" style="color:white; text-decoration:none;">
                      <h3><i>Go To Cart</i></h3>
				</a>
				</button>
			</div>	
			
            <h1 align="center"><i>Products</i></h1><br />

            <?php

             $query = "SELECT * FROM  products ORDER BY id ASC";
             $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
            ?>

			<div class="col-lg-4 col-md-4 col-sm-6">
				<form id="f1" method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
				    <div style="border:1px ; background-color:white; border-radius:5px; padding:16px; height:auto; margin-top:10px; " >
						
							<?php echo "<center><img  align=center src=admin/".$row['thumb']." height=240 width=215 /></center>" ?><br />
							<div class="single-product">
							<div class="product-details">
								    <h6><?php echo $row["name"]; ?></h6>
								<div class="price">
									<h4><b>Rs <?php echo $row["price"]; ?></b></h6>
								</div>
								<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
								<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
								
								<a>Quantity :</a>  
								<input type="number"  name="quantity" min="1" max="10" value="1" style="width:62px" />
								
								
								<div class="prd-bottom">
								<a href="" class="social-info"  >
										
								<button type="submit" name="add_to_cart" style="border:none; padding:0;" >
										<span class="ti-bag" align="left"></span>
										<p class="hover-text" align="left">Add to bag</p>
									
								</button>
								</a>
									<a href="#" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									
									</a>
									<a href="#" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
				    </div>
			    </form> 
			</div> 

		

	    <?php
            }
          }
        ?>
			 
	</div>



	<section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
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
				<center>
                  <form  action="email.php" target="_blank" method="get">
                    <button type="submit"  name="order" class="primary-btn" >
                      ORDER	
                    </button>
                  </form>
				</center>
             </div>
        
        <br />
    </div>   

 </body>
</html>

	