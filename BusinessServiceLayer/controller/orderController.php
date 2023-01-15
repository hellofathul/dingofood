<?php
require_once '../../BusinessServiceLayer/model/orderModel.php';

class orderController{

    //To add new order to Orders table - NUREEN
    function AddOrders(){
        date_default_timezone_set("Asia/Kuala_Lumpur");

        $orders = new orderModel();
        $orders->order_id = $_POST['order_id'];
        $orders->customer_id = $_SESSION['customer_id'];
        $orders->order_detail = $_POST['menu_name'];
        $orders->order_quantity = $_POST['order_quantity'];
        $orders->order_price = $_POST['menu_price'];
        $orders->order_image = $_POST['menu_image'];
        $orders->order_time = date("h:i:sa");
        
        
        if ($orders->AddOrders() > 0){
            $message = "Order Successfully Added!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '../../ApplicationLayer/ManageOrderInterface/cart.php';</script>";
           }
        }

        //To View all order from Orders table - NUREEN
        function viewAllOrder(){
            $orders = new orderModel();
            return $orders->viewAllOrder();
        }

        //To View order from Orders table using customer id - NUREEN
        function viewOrder(){
        //To retrieve orders information from cartModel class to view.
        $orders = new orderModel();
        $orders->customer_id = $_SESSION['customer_id'];
        return $orders->viewOrder();
    }


        function viewCustomer(){
            // get data associate with $id
             $customer = new customerModel();
            $customer->customer_id = $_SESSION['customer_id'];
            return $customer->viewCustomer();
             //retrieve data from customerModel
         }

        
        //To Delete order from Orders table using order id where order_id=order_id - NUREEN
        function deleteOrder(){
            $orders = new orderModel();
            $orders->order_id = $_POST['order_id'];
            if($orders->deleteOrder()){
                $message = "Successfully Deleted Item from the Shopping Cart!";
                echo "<script type='text/javascript'>alert('$message');
                window.location = '../../ApplicationLayer/ManageOrderInterface/cart.php?order_id=".$_POST['order_id']."';</script>";
            }
        }

        //To Update order from Orders table using order id where order_id=order_id - NUREEN
        function updateOrder(){
        // To get and set quantity from cartModel class.
            $orders = new orderModel();
            $orders->order_id = $_POST['order_id'];
            $orders->order_quantity = $_POST['order_quantity'];
            if($orders->updateOrder()){
            $message = "Successfully Updated Quantity!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '../../ApplicationLayer/ManageOrderInterface/cart.php?order_id=".$_POST['order_id']."';</script>";
        }
    }

    function search($name){
         $orders = new orderModel();
        return $orders->search($name);
     }
     } 

?>