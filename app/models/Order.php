<?php

class Order
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllPendingOrders()
  {
    $this->db->query("SELECT *, 
                      tblorder.order_id as orderID, 
                      tbluser.user_id as userID, 
                      tblshipping.shipping_id as shippingID, 
                      tblpayment.payment_id as paymentID
                      FROM tblorder 
                      INNER JOIN tbluser 
                      ON tblorder.user_id = tbluser.user_id 
                      INNER JOIN tblshipping 
                      ON tblorder.shipping_id = tblshipping.shipping_id 
                      INNER JOIN tblpayment 
                      ON tblorder.payment_id = tblpayment.payment_id      
                      AND tblorder.order_status = 0 
                      AND tblpayment.payment_status = 0 
                      ORDER BY tblorder.created_at ASC;");

    $results = $this->db->resultSet();

    return $results;
  }

  public function addToShipping($first_name, $last_name, $email, $contact, $address, $city)
  {
    $this->db->query("INSERT INTO 
                      tblshipping(shipping_first_name, 
                      shipping_last_name, 
                      shipping_email, 
                      shipping_contact, 
                      shipping_address, 
                      shipping_city) 
                      VALUES (:shipping_first_name,
                      :shipping_last_name,
                      :shipping_email,
                      :shipping_contact,
                      :shipping_address,
                      :shipping_city)");
    $this->db->bind(':shipping_first_name', $first_name);
    $this->db->bind(':shipping_last_name', $last_name);
    $this->db->bind(':shipping_email', $email);
    $this->db->bind(':shipping_contact', $contact);
    $this->db->bind(':shipping_address', $address);
    $this->db->bind(':shipping_city', $city);

    return $this->db->insertById();
  }

  public function addToOrder($order_total, $user_id, $shipping_id, $payment_id)
  {
    $this->db->query("INSERT INTO tblorder(order_total,
                      user_id, 
                      shipping_id, 
                      payment_id) 
                      VALUES (:order_total,
                      :user_id,
                      :shipping_id,
                      :payment_id)");

    $this->db->bind(':order_total', $order_total);
    $this->db->bind(':user_id', $user_id);
    $this->db->bind(':shipping_id', $shipping_id);
    $this->db->bind(':payment_id', $payment_id);

    return $this->db->insertById();
  }

  public function addToPayment($payment_method, $shipping_id)
  {
    $this->db->query("INSERT INTO tblpayment(payment_method, 
                      shipping_id) 
                      VALUES (:payment_method,
                      :shipping_id)");

    $this->db->bind(':payment_method', $payment_method);
    $this->db->bind(':shipping_id', $shipping_id);

    return $this->db->insertById();
  }

  public function addToOrderDetails($order_id, $product_id, $user_id, $product_price, $product_quantity, $shipping_id)
  {
    $this->db->query("INSERT INTO tblorderdetails(order_id, 
                      product_id, 
                      user_id, 
                      amount, 
                      quantity, 
                      shipping_id) 
                      VALUES (:order_id,
                      :product_id,
                      :user_id,
                      :product_price,
                      :product_quantity,
                      :shipping_id)");

    $this->db->bind(':order_id', $order_id);
    $this->db->bind(':product_id', $product_id);
    $this->db->bind(':user_id', $user_id);
    $this->db->bind(':product_price', $product_price);
    $this->db->bind(':product_quantity', $product_quantity);
    $this->db->bind(':shipping_id', $shipping_id);

    return $this->db->execute();
  }

  public function getAllOrderDetails($order_id)
  {
    $this->db->query("SELECT *, 
                      tblorderdetails.order_details_id as orderDetailID, 
                      tblorder.order_id as orderID, 
                      tblproduct.product_id as productID, 
                      tbluser.user_id as userID,
                      tblshipping.shipping_id as shippingID
                      FROM tblorderdetails
                      INNER JOIN tblorder 
                      ON tblorderdetails.order_id = tblorder.order_id
                      INNER JOIN tblproduct 
                      ON tblorderdetails.product_id = tblproduct.product_id 
                      INNER JOIN tbluser 
                      ON tblorderdetails.user_id = tbluser.user_id
                      INNER JOIN tblshipping
                      ON tblorderdetails.shipping_id = tblshipping.shipping_id
                      WHERE tblorder.order_id = :order_id
                      ORDER BY tblorderdetails.created_at ASC;");
    $this->db->bind(':order_id', $order_id);

    $orders_detail = $this->db->resultSet();

    return $orders_detail;
  }

  public function getAllOrderDetailsUser($user_id)
  {
    $this->db->query("SELECT *, 
                      tblorderdetails.order_details_id as orderDetailID, 
                      tblorder.order_id as orderID, 
                      tblproduct.product_id as foodID, 
                      tbluser.user_id as userID,
                      tblshipping.shipping_id as shippingID
                      FROM tblorderdetails
                      INNER JOIN tblorder 
                      ON tblorderdetails.order_id = tblorder.order_id
                      INNER JOIN tblproduct 
                      ON tblorderdetails.product_id = tblproduct.product_id 
                      INNER JOIN tbluser 
                      ON tblorderdetails.user_id = tbluser.user_id
                      INNER JOIN tblshipping
                      ON tblorderdetails.shipping_id = tblshipping.shipping_id
                      WHERE tblorder.user_id = :user_id
                      ORDER BY tblorderdetails.created_at ASC;");

    $this->db->bind(':user_id', $user_id);

    $orders_detail = $this->db->resultSet();

    if ($orders_detail) {
      return $orders_detail;
    } else {
      return false;
    }
  }

  public function assignDriver($data)
  {
    $this->db->query('UPDATE `tblorder` SET driver_id=:driver_id WHERE order_id=:id;');

    $this->db->bind(':id', $data['id']);
    $this->db->bind(':driver_id', $data['driver_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function orderComplete($order_id)
  {
    $this->db->query("UPDATE tblorder 
                      SET order_status = 1
                      WHERE order_id = :order_id");

    $this->db->bind(':order_id', $order_id);

    return $this->db->execute();
  }

  public function getAllCompletedOrders()
  {
    $this->db->query("SELECT *, 
                      tblorder.order_id as orderID, 
                      tbluser.user_id as userID, 
                      tblshipping.shipping_id as shippingID, 
                      tblpayment.payment_id as paymentID
                      FROM tblorder
                      INNER JOIN tbluser
                      ON tblorder.user_id = tbluser.user_id 
                      INNER JOIN tblshipping 
                      ON tblorder.shipping_id = tblshipping.shipping_id 
                      INNER JOIN tblpayment 
                      ON tblorder.payment_id = tblpayment.payment_id 
                      AND tblorder.order_status = 1
                      AND tblpayment.payment_status = 1
                      ORDER BY tblorder.created_at ASC;");
    $orders = $this->db->resultSet();

    if ($orders) {
      return $orders;
    } else {
      return false;
    }
  }
}
