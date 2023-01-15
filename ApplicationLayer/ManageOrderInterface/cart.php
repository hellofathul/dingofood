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

require_once '../../BusinessServiceLayer/controller/customerController.php';
require_once '../../libs/database.php';
require_once '../../libs/custSession.php';
require_once '../../BusinessServiceLayer/controller/orderController.php';

$orders = new orderController();
$customer = new customerController();
$cust_data = $customer->viewCustomer();
$data = $orders->viewAllOrder();
//$data = $customer->viewCustomer();
$name = $_SESSION['username'];
$total_quantity = 0;
$total_price = 0;

if(isset($_POST['update'])) {
  $orders->updateOrder();
}

if (isset($_POST ['delete'])) {
  $orders->deleteOrder();
}

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `orders` WHERE CONCAT(`order_detail`, `order_quantity`, `order_price`, ) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `orders`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "dingofood");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <script language="javascript" type="text/javascript">
    window.history.forward();
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300'>

    <meta name="author" content="">

    <title>DINGO FOOD - Food Ordering System (FOS)</title>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    </link>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Project/css/home.css">

    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    span.c{
      display: block;
      width: 100px;
      height: 100px;
      padding: 5px;
      border: 1px solid blue;    
      background-color: yellow; 
    }

    .hero-image {
        background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("/Project/img/dingoLogo4.jfif");
        height: 50%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    .hero-image2 {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/Project/img/wall4.jpg");
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

/* Table header */

.tr_header th a{
    color: black;
  text-align: center;
    text-decoration: none;
}

.tr_header{
    background-color: #darkgrey ;
}

.tr_header th{
    color:black;
    padding:10px 0px;
    letter-spacing: 1px;
  text-align: center;
}

    /* Table rows and columns */
    #emp_table td{
         padding:10px;
        text-align: center;
    }
    #emp_table tr:nth-child(even){
        background-color:lavender;
        color:black;
    }

    #content{
        border:1px solid darkgrey;
        border-radius:3px;
        padding:5px;
        width: 100%;
        margin: 0 auto;
    }

    /* */
    #div_pagination{
        width:100%;
        margin-top:5px;
        text-align:center;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 50px;
        height: 430px;
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .bton {
      display: block;
      line-height: 20px;
      padding: 0 20px;
      -webkit-transition: all 0.4s ease;
      -o-transition: all 0.4s ease;
      -moz-transition: all 0.4s ease;
      transition: all 0.4s ease;
      cursor: pointer;
      font-size: 15px;
      text-transform: uppercase;
      font-weight: 700;
      color: #fff;
      font-family: inherit;
    }
    .btn {
        display: inline-block;
        line-height: 50px;
        padding: 0 50px;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        transition: all 0.4s ease;
        cursor: pointer;
        font-size: 15px;
        text-transform: uppercase;
        font-weight: 700;
        color: #fff;
        font-family: inherit;
    }
    .btn--radius-2 {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
    .btn--red {
        background: #ff4b5a;
    }
    .btn--red:hover {
        background: #eb3746;
    } 
    .btn--black {
        background: #000000;
    }
    .btn--black:hover {
        background: #333333;
    }

    .wrapper {
        margin: 0 auto;
    }
    .wrapper--w790 {
        max-width: 1101px;
    }
    .title {
        font-size: 24px;
        text-transform: uppercase;
        font-weight: 700;
        text-align: center;
        color: #fff;
    }
    .card {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        background: #000;
    }

    .card-5 {
        background: #f1f1f1;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
    }   
    .card-5 .card-heading {
        padding: 20px 0;
        background: #1a1a1a;
        -webkit-border-top-left-radius: 10px;
        -moz-border-radius-topleft: 10px;
        border-top-left-radius: 10px;
        -webkit-border-top-right-radius: 10px;
        -moz-border-radius-topright: 10px;
        border-top-right-radius: 10px;
    }
    .card-5 .card-success {
        padding: 20px 0;
        background: #53d769;
        -webkit-border-top-left-radius: 10px;
        -moz-border-radius-topleft: 10px;
        border-top-left-radius: 10px;
        -webkit-border-top-right-radius: 10px;
        -moz-border-radius-topright: 10px;
        border-top-right-radius: 10px;
    }
    .card-5 .card-body {
        padding: 52px 5px;
        padding-bottom: 73px;
    }

  @media (max-width: 767px) {
    .card-5 .card-body {
        padding: 40px 30px;
        padding-bottom: 50px;
    }
  }
    .bg--white {
        background: #ffffff; }

    .section-padding--lg {
        padding: 50px 0; }

  @media only screen and (min-width: 768px) and (max-width: 991px) {
    .section-padding--lg {
        padding: 100px 0; }
}

@media only screen and (max-width: 767px) {
    .section-padding--lg {
        padding: 70px 0; }
} 
</style>

</head>



<!-- NAVBAR -->

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
<br><br>
           
          <div class="wrapper wrapper--w790">
            <div class="card card-5">
              <div class="card-heading">
                <h2 class="title">Cart</h2>
              </div>
              <div class="card-body">
                <center>
                <form action="/dingofood-1/ApplicationLayer/ManageOrderInterface/cart.php" method="post">
<div style="display:flex;">
  <input type="text" name="valueToSearch" placeholder="Search"> &nbsp;
  <input style="width: 10%; background-color: skyblue; color:black;" type="submit" name="search" value="search">
</div>
<br>
                  <form action="" method="POST">
                    <table id="emp_table" width="100%" border="0" >
                      <tr class="tr_header" >
                        <th></th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    <!-- Error Exception Message -->
                      <?php
                      $i = 1;
                      if (is_array($data) || is_object($data)){
                        foreach($data as $row){
                          $order_quantity = $row["order_quantity"];
                          $price = $row["order_price"] * $order_quantity;
                          $total_quantity += $order_quantity;
                          $total_price += $price;
                          $image =  $row['order_image'];
                          $isrc = '../../img/'; 
                          $p = "chckbox"
                      ?>
                      <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['order_quantity'];?></td>
                    <td><?php echo $row['order_price'];?></td>
                    <td><?php echo $row['order_image'];?></td>
                    
                </tr>
                <?php endwhile;?>
            </table>
        </form>

            <br>
                    <!-- CART DETAILS - maintain by Alia -->
                    
                      <tr>
                        <td><input type="checkbox" id="<?=$p,$i?>" name="<?=$p,$i?>" value="CheckMenu" style="width: 20px; height: 20px;"></td>
                        <td style="text-align:center" ><img src="<?=$isrc,$image?>" width="90"><br> <?=$row['order_detail']?></td>
                        <td style="text-align:center">RM<?=number_format((float)$row['order_price'], 2, '.', '')?></td>
                        <td style="text-align:center" ><input type="number" name="order_quantity" value="<?=$order_quantity?>"> </td>
                        <td style="text-align:center">RM<?=number_format((float)$price, 2, '.', '')?></td>
                        <td style="text-align:center">
                        <button class="btn btn--radius-2 btn--red" type="submit" name="update" value="Update">Update</button>
                          <button class="btn btn--radius-2 btn--red" type="submit" name="delete" value="Delete">Delete</button>
                          <input type="hidden" name="order_id" value="<?=$row['order_id']?>">
                        </td>
                            
                      <?php
                      $i++;

                      echo 
                      "</tr>";
                      ?>
                          

                      <?php
                        }
                      }                
                      ?>

                      <tr>
                        <td></td>
                        <td style="font-size: 25px; color: black; font-weight:bold;">Total:</td>
                        <td></td>
                        <td style="font-size: 25px; color: black; font-weight:bold;"><?=$total_quantity; ?></td>
                        <td style="font-size: 25px; color: red; font-weight:bold;">
                          RM<?=number_format((float)$total_price, 2, '.', ''); ?>
                        </td>
                        <td></td>
                      </tr>

                    </table>

                    <br></br>

                    <?php
                    foreach ($cust_data as $row2) {
                      $customer_name = $row2['customer_name'];
                      $customer_email = $row2['customer_email'];
                      $customer_phoneNo = $row2['customer_phoneNo'];
                      $customer_address = $row2['customer_address'];
                      
                    } ?>

                   <br></br>
                   <td><button style="width: 30%;" class="btn btn--radius-2 btn--black" input type="button" name = "checkout" value="checkout" onclick="location.href='/Project/ApplicationLayer/ManageOrderInterface/checkout.php'">Checkout</button></td>
                   <td>&nbsp</td>
                   <td><button style="width: 30%;" class="btn btn--radius-2 btn--black" input type="button" name = "checkout" value="checkout" onclick="location.href = '/Project/ApplicationLayer/ManageMenuInterface/viewMenu.php'">CONTINUE SHOPPING</button></td>

                   <br></br>
                   <div class="col-sm-20 main-content">



                   
                              

        </form>

      </center>
    </div>
  </div>
</div>
</section>

<!-- CART DETAILS 
                 <h3><center>Order Details</center></h3>
                 <br>
                 Customer ID : <?php echo $name; ?><br><br>
                   <table class="table table-bordered"> 

                    <div id="content">
                     <form id="order-form">
                        <table id="emp_table" width="100%" border="0" >
                            <tr>
                           
                            <th width="20%">Item Name</th>
                            <th width="3%">Quantity</th>
                            <th width="7%">Time</th>
                            <th width="7%">Status</th>
                            <th width="7%"></th>
                            </tr>
                                                <?php
                        foreach($data as $row){
                    ?>
                            <tr>
                           
                            <td class="solid"><?php echo $row['order_detail'];?></td>
                            <td class="solid"><?php echo $row['order_quantity']; ?></td>
                            <td class="solid"><?php echo $row['order_time'];?></td>
                            <td class="solid"><?php echo $row['order_status']; ?></td>
                            </tr>
  <?php
    }
  ?>
                        </table>
                        <script src="../../js/cart.js"></script>
                    </form>

                 </div>
                 <form class="" id="form3" method="post" action='/Project/ApplicationLayer/ManageOrderInterface/checkout.php' align="right">
                   <button type="submit" name="checkout" class="btn btn-primary">CHECKOUT</button>
                 </form>
                 </div>

                 <div style="padding-top:10px;padding-left:500px">
                   <button class="btn btn-dark" onclick="location.href = '/Project/ApplicationLayer/ManageMenuInterface/viewMenu.php' ">CONTINUE SHOPPING</button>

                 </div>

-->



 <br><br><br>
    <!-- Footer -->
    <footer class="p-4 mb-0 bg-secondary">
        <div class="container">
          <center>
            <p class="m-0 text-center text-white">&copy; 2021 DINGO FOOD. All Rights Reserved</p>
          </center>
        </div>
        <!-- /.container -->
    </footer>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


    <!-- Bootstrap core JavaScript -->
    <script src="/Project/vendor/jquery/jquery.min.js"></script>
    <script src="/Project/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/Project/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="/Project/js/jqBootstrapValidation.js"></script>
    <script src="/Project/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/Project/js/agency.min.js"></script>



</body>

</html>