<?php
class Admins extends Controller
{
  public function __construct()
  {
    $this->adminModel = $this->model('Admin');
  }


  public function index()
  {
    if (Auth::adminAuth()) {
      $this->view('admins/index');
    } else {
      redirect('pages');
    }
  }

  public function login()
  {
    if (Auth::adminAuth()) {
      redirect('admins');
    } elseif (Auth::adminGuest()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'username_err' => '',
          'password_err' => '',
        ];

        if (empty($data['username'])) {
          $data['username_err'] = 'Pleae enter username';
        } elseif ($this->adminModel->findUserByRole($data['username']) == false) {
          $data['username_err'] = "You don't have admin credentials";
        } elseif ($this->adminModel->findUserByUsername($data['username']) == false) {
          $data['username_err'] = 'No user found';
        }

        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        }

        if (empty($data['username_err']) && empty($data['password_err'])) {
          $loggedInUser = $this->adminModel->login($data['username'], $data['password']);
          if ($loggedInUser) {
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('admins/login', $data);
          }
        } else {
          $this->view('admins/login', $data);
        }
      } else {
        $data = [
          'username' => '',
          'password' => '',
          'username_err' => '',
          'password_err' => '',
        ];

        $this->view('admins/login', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function createUserSession($admin)
  {
    $_SESSION['admin_id'] = $admin->user_id;
    $_SESSION['admin_email'] = $admin->user_email;
    $_SESSION['admin_name'] = $admin->user_first_name;
    $_SESSION['user_role'] = $admin->user_role;
    redirect('admins/index');
  }

  public function logout()
  {
    if (Auth::adminAuth()) {
      unset($_SESSION['admin_id']);
      unset($_SESSION['admin_email']);
      unset($_SESSION['admin_name']);
      unset($_SESSION['user_role']);
      session_destroy();
      redirect('admins/login');
    } else {
      redirect('pages');
    }
  }
}
