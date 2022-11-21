<?php
class Users extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->cartModel = $this->model('Cart');
    $this->orderModel = $this->model('Order');
  }

  public function index()
  {
    $users = $this->userModel->getAllUsers();
    $data = [
      'users' => $users
    ];

    $this->view('users/index', $data);
  }

  public function signup()
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } elseif (Auth::userGuest()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'first_name' => trim(ucwords($_POST['first_name'])),
          'last_name' => trim(ucwords($_POST['last_name'])),
          'email' => trim($_POST['email']),
          'contact' => trim($_POST['contact']),
          'address' => trim($_POST['address']),
          'city' => trim($_POST['city']),
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'first_name_err' => '',
          'last_name_err' => '',
          'email_err' => '',
          'contact_err' => '',
          'address_err' => '',
          'city_err' => '',
          'username_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        if (empty($data['first_name'])) {
          $data['first_name_err'] = 'Please enter first name';
        } elseif (is_numeric($data['first_name'])) {
          $data['first_name_err'] = 'First name cannot contant any number';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['first_name'])) {
          $data['first_name_err'] = 'First name must only contain letters';
        }

        if (empty($data['last_name'])) {
          $data['last_name_err'] = 'Please enter last name';
        } elseif (is_numeric($data['last_name'])) {
          $data['last_name_err'] = 'Last name cannot contant any number';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['last_name'])) {
          $data['last_name_err'] = 'Last name must only contain letters';
        }

        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter email address';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $data['email_err'] = 'Enter valid email.';
        } elseif ($this->userModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'Email is already taken';
        }

        if (empty($data['contact'])) {
          $data['contact_err'] = 'Please enter contact number';
        } elseif (strlen($data['contact']) < 11) {
          $data['contact_err'] = 'Contact must not be less than 11 characters.';
        } elseif (!is_numeric($data['contact'])) {
          $data['contact_err'] = 'Invalid contact number';
        }

        if (empty($data['address'])) {
          $data['address_err'] = 'Please enter address';
        }

        if (empty($data['city'])) {
          $data['city_err'] = 'Please enter city';
        } elseif (is_numeric($data['city'])) {
          $data['city_err'] = 'Input for city must not have any numeric value';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['city'])) {
          $data['city_err'] = 'City must only contain letters';
        }

        if (empty($data['username'])) {
          $data['username_err'] = 'Please enter username';
        } elseif ($this->userModel->findUserByUsername($data['username'])) {
          $data['username_err'] = 'Username is already taken';
        }

        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        } elseif (strlen($data['password']) < 6) {
          $data['password_err'] = 'Password must be at least 6 characters';
        }


        if (empty($data['confirm_password'])) {
          $data['confirm_password_err'] = 'Please enter confirm password';
        } elseif ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Passwords do not match';
        }

        if (empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['email_err']) && empty($data['contact_err']) && empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {

          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          if ($this->userModel->signup($data)) {
            flash('user_message', 'You are registered');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('users/signup', $data);
        }
      } else {
        $data = [
          'first_name' => '',
          'last_name' => '',
          'email' => '',
          'contact' => '',
          'address' => '',
          'city' => '',
          'username' => '',
          'password' => '',
          'confirm_password' => '',
          'first_name_err' => '',
          'last_name_err' => '',
          'email_err' => '',
          'contact_err' => '',
          'address_err' => '',
          'city_err' => '',
          'username_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        $this->view('users/signup', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function login()
  {
    if (Auth::adminAuth()) {
      redirect('admins/index');
    } elseif (Auth::userGuest()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'username_err' => '',
          'password_err' => '',
        ];

        if (empty($data['username'])) {
          $data['username_err'] = 'Please enter username';
        } elseif ($this->userModel->findUserByUsername($data['username']) == false) {
          $data['username_err'] = 'No user found';
        }

        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        }

        if (empty($data['username_err']) && empty($data['password_err'])) {
          $loggedInUser = $this->userModel->login($data['username'], $data['password']);
          if ($loggedInUser) {
            $this->createUserSession($loggedInUser);
            redirect('pages/index');
          } else {
            $data['password_err'] = 'Password incorrect';
            $this->view('users/login', $data);
          }
        } else {
          $this->view('users/login', $data);
        }
      } else {
        $data = [
          'username' => '',
          'password' => '',
          'username_err' => '',
          'password_err' => '',
        ];

        $this->view('users/login', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->user_id;
    $_SESSION['user_email'] = $user->user_email;
    $_SESSION['user_name'] = $user->user_name;
    $_SESSION['user_role'] = $user->user_role;

    $cartItems = 0;

    $carts = $this->cartModel->getCart($user->user_id);

    if ($carts) {
      foreach ($carts as $cart) {
        $cartItems = $cartItems + $cart->cart_quantity;
        $_SESSION['user_cart'] = $cartItems;
      }
    } else {
      $cartItems = 0;
    }

    $_SESSION['user_cart'] = $cartItems;
  }

  public function logout()
  {
    if (Auth::userAuth()) {
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_role']);
      session_destroy();
      redirect('users/login');
    } else {
      redirect('pages');
    }
  }

  public function profile($user_id)
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } elseif (Auth::userAuth()) {
      $users = $this->userModel->getUserByID($user_id);
      $carts = $this->cartModel->getCart($user_id);
      $orders = $this->orderModel->getAllOrderDetailsUser($user_id);

      $data = [
        'users' => $users,
        'carts' => $carts,
        'orders' => $orders
      ];

      $this->view('users/profile', $data);
    } else {
      redirect('pages');
    }
  }

  public function edit($user_id)
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } elseif (Auth::userAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'user_id' => $user_id,
          'username' => trim($_POST['username']),
          'first_name' => trim($_POST['first_name']),
          'last_name' => trim($_POST['last_name']),
          'email' => trim($_POST['email']),
          'contact' => trim($_POST['contact']),
          'address' => trim($_POST['address']),
          'city' => trim($_POST['city']),
          'username_err' => '',
          'first_name_err' => '',
          'last_name_err' => '',
          'email_err' => '',
          'contact_err' => '',
          'address_err' => '',
          'city_err' => ''
        ];

        if (empty($data['first_name'])) {
          $data['first_name_err'] = 'Please enter first name';
        } elseif (is_numeric($data['first_name'])) {
          $data['first_name_err'] = 'Name could not contain any number character';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['first_name'])) {
          $data['first_name_err'] = 'Name must only contain letters';
        }

        if (empty($data['last_name'])) {
          $data['last_name_err'] = 'Please enter last name';
        } elseif (is_numeric($data['first_name'])) {
          $data['last_name_err'] = 'Name could not contain any number character';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['last_name'])) {
          $data['last_name_err'] = 'Name must only contain letters';
        }

        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter email';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $data['email_err'] = 'Enter valid email.';
        } else {
          if ($this->userModel->findUserByEmail($data['email'])) {
            $user = $this->userModel->getUserByID($data['user_id']);
            if ($user->user_email == $data['email']) {
              $data['email_err'] = '';
            } else {
              $data['email_err'] = 'Email is already taken';
            }
          }
        }

        if (empty($data['username'])) {
          $data['username_err'] = 'Please enter username';
        } elseif (!preg_match("/^[a-zA-Z0-9_.-]*$/", $data['username'])) {
          $data['username_err'] = 'Username cannot contain any special character';
        } else {
          if ($this->userModel->findUserByUsername($data['username'])) {
            $user = $this->userModel->getUserByID($data['user_id']);
            if ($user->user_username == $data['username']) {
              $data['username_err'] = '';
            } else {
              $data['username_err'] = 'Username is already taken';
            }
          }
        }

        if (empty($data['address'])) {
          $data['address_err'] = 'Please enter address';
        }

        if (empty($data['contact'])) {
          $data['contact_err'] = 'Please enter contact number';
        } elseif (strlen($data['contact']) < 11) {
          $data['contact_err'] = 'Contact must not be less than 11 characters.';
        } else {
          if (!is_numeric($data['contact'])) {
            $data['contact_err'] = 'Invalid contact number';
          }
        }

        if (empty($data['city'])) {
          $data['city_err'] = 'Please insert city';
        } elseif (is_numeric($data['city'])) {
          $data['city_err'] = 'Input for city must not have any numeric value';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['city'])) {
          $data['city_err'] = 'City must only contain letters';
        }

        if (empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['email_err']) && empty($data['contact_err']) && empty($data['address_err']) && empty($data['username_err'])) {
          if ($this->userModel->editUser($data)) {
            flash('user_message', 'User Details Updated');
            redirect('users/profile/' . $data['user_id']);
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('users/edit', $data);
        }
      } else {
        $users = $this->userModel->getUserByID($user_id);
        $data = [
          'user_id' => $users->user_id,
          'username' => $users->user_username,
          'first_name' => $users->user_first_name,
          'last_name' => $users->user_last_name,
          'email' => $users->user_email,
          'contact' => $users->user_contact,
          'address' => $users->user_address,
          'city' => $users->user_city,
          'username_err' => '',
          'name_err' => '',
          'email_err' => '',
          'contact_err' => '',
          'address_err' => '',
          'city_err' => ''
        ];

        $this->view('users/edit', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function avatar($user_id)
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } elseif (Auth::userAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['user_image']) {
        $data = [
          'user' => $user_id,
          'user_image' => $_FILES['user_image']['name'],
          'user_image_tmp' => $_FILES['user_image']['tmp_name'],
          'user_image_err' => ''
        ];

        if (empty($data['user_image'])) {
          $data['user_image_err'] = "Please input an image";
        }

        if (empty($data['user_image_err'])) {
          move_uploaded_file($data['user_image_tmp'], dirname(APPROOT) . '\public\img\\' . $data['user_image']);
          if ($this->userModel->avatar($user_id, $data['user_image'])) {
            flash('user_message', 'Profile Picture Successfully Updated');
            redirect('users/profile/' . $user_id);
          } else {
            die('Something went wrong');
          }
        }
      } else {
        $data = [
          'user' => $user_id,
        ];

        $this->view('users/avatar', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function forgot()
  {
    if (Auth::adminAuth()) {
      redirect('admin/index');
    } else {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        $data = [
          'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
          'token' => $token,
          'email_err' => ''
        ];

        if (empty($data['email'])) {
          $data['email_err'] = 'Please input you email';
        }

        if (empty($data['email_err'])) {
          if ($this->userModel->forgotPassword($data['email'], $data['token'])) {
            Email::sendPass($data['email'], $data['token']);
            flash('user_message', 'Please your email for password reset');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('users/forgot', $data);
        }
      } else {
        $data = [
          'email' => '',
          'email_err' => ''
        ];

        $this->view('users/forgot', $data);
      }
    }
  }
}
