<?php
class Driver
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllDrivers()
  {
    $this->db->query('SELECT * FROM tbldeliverydriver');

    $results = $this->db->resultSet();

    return $results;
  }

  public function add($data)
  {
    $this->db->query('INSERT INTO 
                      tbldeliverydriver (driver_first_name, 
                      driver_last_name, 
                      driver_email, 
                      driver_contact, 
                      driver_address, 
                      driver_city, 
                      driver_username, 
                      driver_password) 
                      VALUES (:first_name,
                      :last_name,
                      :email,
                      :contact,
                      :address,
                      :city,
                      :username,
                      :password
                      )');

    $this->db->bind(':first_name', $data['driver_first_name']);
    $this->db->bind(':last_name', $data['driver_last_name']);
    $this->db->bind(':email', $data['driver_email']);
    $this->db->bind(':contact', $data['driver_contact']);
    $this->db->bind(':address', $data['driver_address']);
    $this->db->bind(':city', $data['driver_city']);
    $this->db->bind(':username', $data['driver_username']);
    $this->db->bind(':password', $data['driver_password']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getAllAvailableDrivers()
  {
    $this->db->query('SELECT * FROM tbldeliverydriver WHERE driver_status = 0;');

    $results = $this->db->resultSet();

    return $results;
  }

  public function findDriverByUsername($driver_username)
  {
    $this->db->query('SELECT * FROM tbldeliverydriver WHERE driver_username = :driver_username');

    $this->db->bind(':driver_username', $driver_username);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function changeDriverStatusOnDelivery($driver_id)
  {
    $this->db->query('UPDATE tbldeliverydriver SET driver_status = 1 WHERE driver_id = :driver_id');

    $this->db->bind(':driver_id', $driver_id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function changeDriverStatusAvailable($driver_id)
  {
    $this->db->query('UPDATE tbldeliverydriver SET driver_status = 0 WHERE driver_id = :driver_id');

    $this->db->bind(':driver_id', $driver_id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
