<?php

class Admin
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function login($username, $password)
  {
    $this->db->query('SELECT * FROM tbluser WHERE user_username = :username AND user_role = "admin"');
    $this->db->bind(':username', $username);

    $row = $this->db->single();

    $hashed_password = $row->user_password;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM tbluser WHERE user_email = :email AND user_role = "admin"');

    $this->db->bind(':email', $email);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function findUserByUsername($username)
  {
    $this->db->query('SELECT * FROM tbluser WHERE user_username = :username AND user_role = "admin"');

    $this->db->bind(':username', $username);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function findUserByRole($username)
  {
    $this->db->query("SELECT user_role FROM tbluser WHERE user_username = :username");

    $this->db->bind(':username', $username);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      if ($row->user_role == 'admin') {
        return true;
      }
    } else {
      return true;
    }
  }
}
