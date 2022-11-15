<?php

class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function signup($data)
  {
    $this->db->query('INSERT INTO 
                      tbluser (user_first_name, 
                      user_last_name, 
                      user_email, 
                      user_contact, 
                      user_address, 
                      user_city, 
                      user_username, 
                      user_password) 
                      VALUES (:first_name,
                      :last_name,
                      :email,
                      :contact,
                      :address,
                      :city,
                      :username,
                      :password
                      )');

    $this->db->bind(':first_name', $data['first_name']);
    $this->db->bind(':last_name', $data['last_name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':contact', $data['contact']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':city', $data['city']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':password', $data['password']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function login($username, $password)
  {
    $this->db->query('SELECT * FROM tbluser WHERE user_username = :username AND user_role = "user"');
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
    $this->db->query('SELECT * FROM tbluser WHERE user_email = :email AND user_role = "user"');

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
    $this->db->query('SELECT * FROM tbluser WHERE user_username = :username AND user_role = "user"');

    $this->db->bind(':username', $username);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function getUserByID($id)
  {
    $this->db->query('SELECT * FROM tbluser WHERE user_id = :id');

    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function editUser($data)
  {
    $this->db->query("UPDATE tbluser 
                      SET user_username = :user_username,
                      user_first_name = :user_first_name,
                      user_last_name = :user_last_name,
                      user_email = :user_email,
                      user_contact = :user_contact,
                      user_address = :user_address,
                      user_city = :user_city
                      WHERE user_id = :user_id");

    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':user_username', $data['username']);
    $this->db->bind(':user_first_name', $data['first_name']);
    $this->db->bind(':user_last_name', $data['last_name']);
    $this->db->bind(':user_email', $data['email']);
    $this->db->bind(':user_contact', $data['contact']);
    $this->db->bind(':user_address', $data['address']);
    $this->db->bind(':user_city', $data['city']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function avatar($user_id, $user_image)
  {
    $this->db->query("UPDATE tbluser SET user_image = :user_image
                      WHERE user_id = :user_id");
    $this->db->bind(':user_image', $user_image);
    $this->db->bind(':user_id', $user_id);
    $this->db->execute();

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getAllUsers()
  {
    $this->db->query("SELECT * FROM tbluser");

    $this->db->execute();

    $users = $this->db->resultset();

    if ($users) {
      return $users;
    } else {
      return false;
    }
  }
}
