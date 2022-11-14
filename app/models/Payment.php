<?php

class Payment
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function paymentComplete($payment_id)
  {
    $this->db->query("UPDATE tblpayment 
                      SET payment_status = 1
                      WHERE payment_id = :payment_id");

    $this->db->bind(':payment_id', $payment_id);

    return $this->db->execute();
  }
}
