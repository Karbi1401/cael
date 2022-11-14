<?php
class Carts extends Controller
{
  public function __construct()
  {
    $this->cartModel = $this->model('Cart');
    $this->userModel = $this->model('User');
    $this->orderModel = $this->model('Order');
  }


  public function index()
  {
    if (Auth::userAuth()) {
      $cartItems = 0;
      $id = $_SESSION['user_id'];
      $carts = $this->cartModel->getCart($id);

      $data = [
        'carts' => $carts
      ];

      if ($data['carts']) {
        foreach ($data['carts'] as $cart) {
          $cartItems = $cartItems + $cart->cart_quantity;
          $_SESSION['user_cart'] = $cartItems;
        }
      } else {
        $cartItems = 0;
      }

      $_SESSION['user_cart'] = $cartItems;
      $this->view('carts/index', $data);
    } else {
      redirect('pages');
    }
  }

  public function add($id, $price)
  {
    if (Auth::userAuth()) {
      $data = [
        'id' => $id,
        'price' => $price,
        'user_id' => $_SESSION['user_id']
      ];

      if ($this->cartModel->findCartProduct($id, $data['user_id']) > 0) {
        $this->cartModel->addOne($id, $data['user_id']);
        flash('cart_message', 'Item added to the cart');
        redirect('pages/menu');
      } else {
        $this->cartModel->addNew($id, $data['user_id'], $price);
        flash('cart_message', 'Item added to the cart');
        redirect('pages/menu');
      }
    } else {
      redirect('users/login');
    }
  }

  public function delete($id)
  {
    if (Auth::userAuth()) {
      $delete =  $this->cartModel->deleteCartItem($id);
      if ($delete) {
        flash('cart_message', 'Item has been removed from the cart');
        redirect('carts');
      }
    } else {
      redirect('pages');
    }
  }

  public function clear()
  {
    if (Auth::userAuth()) {
      $delete = $this->cartModel->clearCart();
      if ($delete) {
        flash('cart_message', 'Items in the cart successfully removed');
        redirect('carts');
      }
    } else {
      redirect('pages');
    }
  }

  public function updateQuantity($id)
  {
    if (Auth::userAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $qty = $_POST['quantity'];
        if (!is_numeric($qty)) {
          flash('cart_message', 'Quantity must be a number');
          redirect('carts/index');
        } elseif ($qty < 1 && empty($qty)) {
          flash('cart_message', 'Quantity must not be less than 1');
          redirect('carts/index');
        } else {
          $this->cartModel->updateQty($id, $qty);
          flash('cart_message', 'Quantity has been updated');
          redirect('carts/index');
        }
      }
    } else {
      redirect('pages');
    }
  }

  public function checkout()
  {
    if (Auth::userAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'first_name' => trim($_POST['first_name']),
          'last_name' => trim($_POST['last_name']),
          'email' => trim($_POST['email']),
          'contact' => trim($_POST['contact']),
          'address' => trim($_POST['address']),
          'city' => trim($_POST['city']),
          'payment_method' => trim($_POST['payment_method']),
          'total' => $_POST['total'],
          'qty' => $_POST['qty'],
          'first_name_err' => '',
          'last_name_err' => '',
          'email_err' => '',
          'contact_err' => '',
          'address_err' => '',
          'city_err' => '',
          'payment_method_err' => ''
        ];

        if (is_numeric($data['first_name'])) {
          $data['first_name_err'] = 'First name could not contain any number character.';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['first_name'])) {
          $data['first_name_err'] = 'First name must only contain letters.';
        }

        if (is_numeric($data['last_name'])) {
          $data['last_name_err'] = 'Last name could not contain any number character.';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['last_name'])) {
          $data['last_name_err'] = 'Last name must only contain letters.';
        }

        if (empty($data['email'])) {
          $data['email_err'] = 'Email must have a value.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $data['email_err'] = 'Pleae enter a valid email.';
        }

        if (empty($data['contact'])) {
          $data['contact_err'] = 'Contact must not be empty.';
        } elseif (strlen($data['contact']) < 11) {
          $data['contact_err'] = 'Contact must not be less than 11 characters.';
        } elseif (!is_numeric($data['contact'])) {
          $data['contact_err'] = 'Invalid contact please input numbers only.';
        }

        if (empty($data['address'])) {
          $data['address_err'] = 'Address must have a value.';
        }

        if (empty($data['city'])) {
          $data['city_err'] = 'City must have a value.';
        } elseif (is_numeric($data['city'])) {
          $data['city_err'] == 'City must not have a number.';
        }

        if (empty($_POST['payment_method'])) {
          $data['payment_method_err'] = 'You must choose payment method';
        }

        if (empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['email_err']) && empty($data['contact_err']) && empty($data['address_err']) && empty($data['city_err']) && empty($data['payment_method_err'])) {

          $shipping_id = $this->orderModel->addToShipping($data['first_name'], $data['last_name'], $data['email'], $data['contact'], $data['address'], $data['city']);

          $_SESSION['shipping_id'] = $shipping_id;

          $payment_id = $this->orderModel->addToPayment($_POST['payment_method'], $shipping_id);

          $order_id = $this->orderModel->addToOrder($data['total'], $_SESSION['user_id'], $shipping_id, $payment_id);

          $data['carts'] = $this->cartModel->getCart($_SESSION['user_id']);

          $shipping_id = (int)$shipping_id;

          foreach ($data['carts'] as $cart) {
            $this->orderModel->addToOrderDetails(
              $order_id,
              $cart->product_id,
              $_SESSION['user_id'],
              $cart->cart_price,
              $cart->cart_quantity,
              $shipping_id
            );
          }

          $orders = $this->orderModel->getAllOrderDetails($order_id);

          $this->cartModel->clearCart();

          $_SESSION['user_cart'] = '0';

          flash('cart_message', 'Order successfully submitted');

          redirect("carts");
        }
      } else {
        $id = $_SESSION['user_id'];
        $carts = $this->cartModel->getCart($id);
        $users = $this->userModel->getUserByID($id);
        $data = [
          'carts' => $carts,
          'first_name' => $users->user_first_name,
          'last_name' => $users->user_last_name,
          'email' => $users->user_email,
          'contact' => $users->user_contact,
          'address' => $users->user_address,
          'city' => $users->user_city,
          'payment_method' => '',
          'first_name_err' => '',
          'email_err' => '',
          'contact_err' => '',
          'address_err' => '',
          'city_err' => '',
          'payment_method_err' => '',
          'order_schedule_err' => ''
        ];

        $this->view('pages/checkout', $data);
      }
    } else {
      redirect('pages');
    }
  }
}
