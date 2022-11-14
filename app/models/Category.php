<?php

class Category
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getCategory()
  {
    $this->db->query("SELECT *,
											tblcategory.category_id as catID,
											tblcategory.category_name as categoryName,
											tbluser.user_id as userID,
											tblcategory.category_status as categoryStatus,
											tblcategory.created_at as categoryCreated
											FROM tblcategory
											INNER JOIN tbluser
											ON tblcategory.user_id = tbluser.user_id
											ORDER BY tblcategory.created_at ASC
											");

    $results = $this->db->resultSet();

    return $results;
  }

  public function getCategoryByID($id)
  {
    $this->db->query('SELECT * FROM tblcategory WHERE category_id = :id');

    $this->db->bind(':id', $id);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }

  public function getCategoryByStatus()
  {
    $this->db->query('SELECT * FROM tblcategory WHERE category_status = 1');

    $results = $this->db->resultSet();

    return $results;
  }

  public function addCategory($data)
  {
    $this->db->query("INSERT INTO 
            					tblcategory (category_name, user_id)
            					VALUES (:category_name, :user_id)");

    $this->db->bind(':category_name', $data['category_name']);
    $this->db->bind(':user_id', $data['admin_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updateCategory($data)
  {
    $this->db->query('UPDATE tblcategory SET category_status = :category_status, category_name = :category_name WHERE category_id = :id');

    $this->db->bind(':id', $data['id']);
    $this->db->bind(':category_name', $data['category_name']);
    $this->db->bind(':category_status', $data['category_status']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteCategory($id)
  {
    $this->db->query('DELETE FROM tblcategory WHERE category_id = :id');

    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function findCategoryName($data)
  {
    $this->db->query('SELECT * FROM tblcategory WHERE category_name = :category_name');

    $this->db->bind(':category_name', $data['category_name']);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
