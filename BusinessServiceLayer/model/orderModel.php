<?php
require_once '../../libs/database.php';

// public variable - NUREEN
class orderModel{
    public $order_id,$order_detail,$order_quantity,$order_price,$order_image,$order_time; 
    
    //To insert order into Orders table - NUREEN
    function AddOrders(){
        $sql = "insert into orders(order_id,customer_id,order_detail,order_quantity,order_price,order_image,order_time) values(:order_id,:customer_id,:order_detail, :order_quantity, :order_price, :order_image, :order_time)";
        $args = [':order_id'=>$this->order_id,'customer_id'=>$this->customer_id,':order_detail'=>$this->order_detail, ':order_quantity'=>$this->order_quantity, ':order_price'=>$this->order_price,':order_image'=>$this->order_image, ':order_time'=>$this->order_time];
        $stmt = DB::run($sql, $args);
        $count = $stmt->rowCount();
        return $count;
    }

    //To retrieve all order from Orders table - NUREEN
    function viewAllOrder(){
       $sql = "SELECT * FROM orders";
        return DB::run($sql);}

    //To retrieve order information from cart table where customer_id=customer_id and send them to cartController class - NUREEN
    function viewOrder(){
        $sql = "select * from orders customer_id=:customer_id";
        $args = [':customer_id'=>$this->customer_id];
        return DB::run($sql,$args);
    }

    //To get the current customer information to display at checkout page - NABILAH
    function viewCustomer(){
        $sql = "select * from customer where customer_id=:customer_id";
        $args = [':customer_id'=>$this->customer_id];
        return DB::run($sql,$args);
  }

    //To update cart where order_id=order_id - NUREEN
    function updateOrder(){
        $sql = "update orders set order_quantity=:order_quantity where order_id=:order_id";
        $args = [':order_quantity'=>$this->order_quantity, ':order_id'=>$this->order_id];
        return DB::run($sql,$args);
    }

    //To delete cart from cart where order_id=order_id - NUREEN
    function deleteOrder(){
        $sql = "delete from orders where order_id=:order_id";
        $args = [':order_id'=>$this->order_id];
        return DB::run($sql,$args);
    }

    //Search
    function search($name){
        $sql = "SELECT * FROM orders WHERE order_detail =  '$name'";
         return DB::run($sql);}

    }

?>

