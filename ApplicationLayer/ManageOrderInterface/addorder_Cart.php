
<?php

/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'dingofood';
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$conn=mysqli_connect($host,$user,$pass,$database);
if($conn){
}else{
     echo"Connection not successful" . mysqli_error($conn);
     die($conn);
}

require_once '../../BusinessServiceLayer/controller/orderController.php';
require_once 'C:/xampp/htdocs/dingofood-1/BusinessServiceLayer/controller/menuController.php';
require_once '../../libs/database.php';
require_once '../../libs/custSession.php';


$orders = new orderController();
$menu = new menuController();
$menu_id = $_GET['id']; 
$data = $menu->viewMenu($menu_id);

if(isset($_POST['add']))
{
  $orders->AddOrders();
  

}

$name = $_SESSION['username'];

?>

<!DOCTYPE html>
   <html lang="en" dir="ltr">
      <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300'>

        <meta name="author" content="">
      
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
       
         <script src="https://kit.fontawesome.com/e40306d6a0.js" crossorigin="anonymous"></script>
         <title>DINGO FOOD - Food Ordering System (FOS)</title>
         <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
        rel="stylesheet"  type='text/css'>
        </link>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/Project/css/home.css">

<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("/Project/img/dingoLogo3.jfif");
  height: 50%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  background-color: #ddd;
  text-align: center;
  cursor: pointer;
}

.hero-text button:hover {
  background-color: #555;
  color: white;
}

ul {
    list-style-type: none;

}


/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 50px;
    height: 430px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>

</head>

<body>

<div class="hero-image">
        <div class="hero-text">
            <h1 style="font-size:70px">D I N G O F O O D</h1>
            <p style="color: black">Everything's Fresh Here at DingoFood</p><br>
        </div>
    </div>

    <div id="menu-nav">
        <div style="list-style-type: none;" id="navigation-bar">
        <ul>
                <li><a href="/Project/ApplicationLayer/ManageCustomerInterface/home.php"><i class="fa fa-home"></i><span>Home</span></a></li>
                <li><a href="/Project/ApplicationLayer/ManageMenuInterface/viewMenu.php"><i class="fa fa-book"></i><span>Menu</span></a></li>
                
                <li><a href="/Project/ApplicationLayer/ManageOrderInterface/cart.php"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                <li><a href="/Project/ApplicationLayer/ManageRefundInterface/refundList.php"><i class="fa fa-money"></i><span>Refund</span></a></li>
                <li><a href="/Project/ApplicationLayer/ManageCustomerInterface/logout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class="fa fa-sign-out"></i><span>Sign Out</span></a></li>
                
                <a href="/Project/ApplicationLayer/ManageCustomerInterface/customerProfile.php" id="topnav-right"><i class="fa fa-user"></i><span>Hello <?php echo $name; ?></span></a>
            </ul>

        </div>

    </div>
<form action="" method="POST">
<?php

    foreach($data as $row){
?>

<div class="row">
  <div class="column">
    <center><img src="../../img/<?php echo $row['menu_image'];?>" width="340" height="340"></center>
  </div>

  <div class="column" style="background-color:#c69f9f;">
    <h2><b><?= $row['menu_name']?></b></h2>
    <p><?= $row['menu_description']?></p>
    <br><h4><b>Price : RM <?= $row['menu_price']?> </b></h4>

    <input type="hidden" name="order_id" value="<?= $row['order_id']?>">
    <input type="hidden" name="menu_name" value="<?= $row['menu_name']?>">
    <input type="hidden" name="order_quantity" value="<?= $row['order_quantity']?>">
    <input type="hidden" name="menu_price" value="<?= $row['menu_price']?>">
    <input type="hidden" name="menu_image" value="<?= $row['menu_image']?>">
    <br><p>Quantity : <br> <br><input type="number" id="order_quantity" name="order_quantity" class="form-control" value="1" min="1" max="5"></p>

    <br>
                  

                  <?php
                  $name = $_SESSION['username'];
                    ?>
                    <input type="hidden" name="name" value="<?=$row['menu_name']?>">
                    <input type="hidden" name="price" value="<?=$row['menu_price']?>">
                  
                    <input type="hidden" name="image" value="<?=$row['menu_image']?>">
                    <!-- <input type="hidden" name="order_quantity" value="<?=$row['order_quantity']?>"> -->
                   
                    <center><button class="btn btn-primary" type="submit" name="add" value="Add to Cart"> Add to Cart </button></center>
                   

              
                  
                </center>
              </div>
                </form></td>
            <?php } ?>

<!--
<form action="" method="POST">
<?php
    foreach($data as $row){
?>

<div class="row">
  <div class="column">
    <center><img src="../../img/<?php echo $row['menu_image'];?>" width="340" height="340"></center>
  </div>

  <div class="column" style="background-color:#c69f9f;">
    <h2><b><?= $row['menu_name']?></b></h2>
    <p><?= $row['menu_description']?></p>
    <br><h4><b>Price : RM <?= $row['menu_price']?> </b></h4>

    <input type="hidden" name="order_id" value="<?= $row['order_id']?>">
    <input type="hidden" name="menu_name" value="<?= $row['menu_name']?>">
    <br><p>Quantity : <br> <br><input type="number" id="order_quantity" name="order_quantity" class="form-control" value="1" min="1" max="5"></p>
    <br>
    <center><div class="clear-float">
   
    <button id="addCart" type="submit" name="add" class="btn btn-primary">Add to cart</button>

   </center></div>

  </div>

  <?php
    }
  ?>
  </form>
    <br><br>-->

    <!-- Footer -->
    <footer class="p-4 mb-0 bg-secondary">
     <div class="container">
       <p class="m-0 text-center text-white">&copy; 2021 DINGO FOOD. All Rights Reserved</p>
     </div>
    </footer>


</body>

</html>
