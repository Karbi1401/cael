<?php

class Product
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getProduct()
  {
    $this->db->query('SELECT *,
                      tblcategory.category_name as categoryName
                      FROM tblproduct
                      INNER JOIN tblcategory
                      ON tblproduct.category_id = tblcategory.category_id
                      ORDER BY tblproduct.created_at ASC');

    $results = $this->db->resultSet();

    return $results;
  }

  public function getProductByStatus()
  {
    $this->db->query('SELECT * FROM tblproduct WHERE product_status = 1 ORDER BY created_at ASC');

    $results = $this->db->resultSet();

    return $results;
  }

  public function getProductByName($data)
  {
    $this->db->query('SELECT * FROM tblproduct WHERE product_name = :product_name');

    $this->db->bind(':product_name', $data['product_name']);

    $row = $this->db->single();

    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function getProductByID($id)
  {
    $this->db->query('SELECT * FROM tblproduct WHERE product_id = :id');

    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function getProductByCategory($id)
  {
    $this->db->query('SELECT *,
                      tblproduct.category_id as tblProduct_ID,
                      tblcategory.category_id as tblCategory_ID
                      FROM tblproduct
                      INNER JOIN tblcategory
                      ON tblproduct.category_id = tblcategory.category_id
                      WHERE tblcategory.category_id = :id
                      ORDER BY tblproduct.created_at ASC');

    $this->db->bind(':id', $id);

    $results = $this->db->resultSet();

    return $results;
  }

  public function addProduct($data)
  {
    $this->db->query("INSERT INTO tblproduct 
                      (product_name,
                      product_price,
                      product_description,
                      product_image,
                      category_id) 
                      VALUES (:product_name,
                      :product_price,
                      :product_description,
                      :product_image,
                      :category_id)");

    $this->db->bind(':product_name', $data['product_name']);
    $this->db->bind(':product_price', $data['product_price']);
    $this->db->bind(':product_description', $data['product_description']);
    $this->db->bind(':product_image', $data['product_image']);
    $this->db->bind(':category_id', $data['category_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updateProduct($data)
  {
    $this->db->query('UPDATE tblproduct 
                      SET product_name = :product_name, 
                      product_price = :product_price, 
                      product_image = :product_image, 
                      product_description = :product_description, 
                      product_status = :product_status, 
                      category_id = :category_id 
                      WHERE product_id = :id');

    $this->db->bind(':id', $data['id']);
    $this->db->bind(':product_name', $data['product_name']);
    $this->db->bind(':product_price', $data['product_price']);
    $this->db->bind(':product_image', $data['product_image']);
    $this->db->bind(':product_description', $data['product_description']);
    $this->db->bind(':product_status', $data['product_status']);
    $this->db->bind(':category_id', $data['category_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteProduct($id)
  {
    $this->db->query('DELETE FROM tblproduct WHERE product_id = :id');

    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
