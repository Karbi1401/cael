<?php
class Categories extends Controller
{
  public function __construct()
  {
    $this->categoryModel = $this->model('Category');
  }


  public function index()
  {
    if (Auth::adminAuth()) {
      $categories = $this->categoryModel->getCategory();

      $data = [
        'categories' => $categories
      ];

      $this->view('categories/index', $data);
    } else {
      redirect('pages');
    }
  }

  public function add()
  {
    if (Auth::adminAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'category_name' => trim($_POST['category_name']),
          'admin_id' => $_SESSION['admin_id'],
          'category_name_err' => ''
        ];

        if (empty($data['category_name'])) {
          $data['category_name_err'] = 'Please enter category name';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['category_name'])) {
          $data['category_name_err'] = 'Category name must only contain letters';
        } elseif ($this->categoryModel->findCategoryName($data) > 0) {
          $data['category_name_err'] = 'Category name already exist please choose another one';
        }

        if (empty($data['category_name_err'])) {
          if ($this->categoryModel->addCategory($data)) {
            flash('category_message', 'Category Added');
            redirect('categories');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('categories/add', $data);
        }
      } else {
        $data = [
          'category_name' => '',
          'admin_id' => '',
          'category_name_err' => ''
        ];

        $this->view('categories/add', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function edit($id)
  {
    if (Auth::adminAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'id' => $id,
          'category_name' => $_POST['category_name'],
          'category_status' => $_POST['category_status'],
          'category_name_err' => ''
        ];

        if (empty($data['category_name'])) {
          $data['category_name_err'] = 'Please enter category name';
        } elseif (is_numeric($data['category_name'])) {
          $data['category_name_err'] = 'Category name could not contain any numeric value';
        }

        if (empty($data['category_name_err'])) {
          if ($this->categoryModel->updateCategory($data)) {
            flash('category_message', 'Category Updated');
            redirect('categories');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('categories/edit', $data);
        }
      } else {
        $categories = $this->categoryModel->getCategoryByID($id);
        $data = [
          'id' => $id,
          'category_name' => $categories->category_name,
          'category_name_err' => ''
        ];

        $this->view('categories/edit', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function delete($id)
  {
    if (Auth::adminAuth()) {
      if ($this->categoryModel->deleteCategory($id)) {
        flash('category_message', 'Category Removed');
        redirect('categories');
      } else {
        die('Something went wrong');
        redirect('categories');
      }
    } else {
      redirect('pages');
    }
  }
}
