<?php
class Pages extends Controller
{
  public function __construct()
  {
    $this->productModel = $this->model('Product');
    $this->categoryModel = $this->model('Category');
    $this->cartModel = $this->model('Cart');
  }

  public function index()
  {
    if (Auth::adminAuth()) {
      session_destroy();
      redirect('admins');
    } else {
      $this->view('pages/index');
    }
  }

  public function menu()
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } elseif (isset($_SESSION['user_id'])) {
      $id = $_SESSION['user_id'];
      $cartItems = 0;
      $products = $this->productModel->getProductByStatus();
      $categories = $this->categoryModel->getCategoryByStatus();
      $carts = $this->cartModel->getCart($id);

      if ($carts) {
        foreach ($carts as $cart) {
          $cartItems = $cartItems + $cart->cart_quantity;
          $_SESSION['user_cart'] = $cartItems;
        }
      } else {
        $cartItems = 0;
      }

      $_SESSION['user_cart'] = $cartItems;

      $data = [
        'products' => $products,
        'categories' => $categories
      ];

      $this->view('pages/menu', $data);
    } else {
      $products = $this->productModel->getProductByStatus();
      $categories = $this->categoryModel->getCategoryByStatus();

      $data = [
        'categories' => $categories,
        'products' => $products
      ];

      $this->view('pages/menu', $data);
    }
  }

  public function details($id)
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } else {
      $products = $this->productModel->getProductByID($id);

      $data = [
        'products' => $products
      ];

      $this->view('pages/details', $data);
    }
  }

  public function category($id)
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } else {
      $categories = $this->categoryModel->getCategoryByStatus();
      $products = $this->productModel->getProductByCategory($id);

      $data = [
        'categories' => $categories,
        'products' => $products
      ];

      $this->view('pages/category', $data);
    }
  }
}
