<?php
class Drivers extends Controller
{
  public function __construct()
  {
    $this->driverModel = $this->model('Driver');
  }

  public function index()
  {
    if (Auth::adminAuth()) {
      $drivers = $this->driverModel->getAllDrivers();

      $data = [
        'drivers' => $drivers
      ];

      $this->view('drivers/index', $data);
    } else {
      redirect('pages');
    }
  }

  public function add()
  {
    if (Auth::adminAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'driver_first_name' => trim(ucwords($_POST['driver_first_name'])),
          'driver_last_name' => trim(ucwords($_POST['driver_last_name'])),
          'driver_email' => trim($_POST['driver_email']),
          'driver_contact' => trim($_POST['driver_contact']),
          'driver_address' => trim($_POST['driver_address']),
          'driver_city' => trim($_POST['driver_city']),
          'driver_username' => trim($_POST['driver_username']),
          'driver_password' => trim($_POST['driver_password']),
          'driver_confirm_password' => trim($_POST['driver_confirm_password']),
          'driver_first_name_err' => '',
          'driver_last_name_err' => '',
          'driver_email_err' => '',
          'driver_contact_err' => '',
          'driver_address_err' => '',
          'driver_city_err' => '',
          'driver_username_err' => '',
          'driver_password_err' => '',
          'driver_confirm_password_err' => ''
        ];

        if (empty($data['driver_first_name'])) {
          $data['driver_first_name_err'] = 'Please enter first name';
        } elseif (is_numeric($data['driver_first_name'])) {
          $data['driver_first_name_err'] = 'First name cannot contant any number';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['driver_first_name'])) {
          $data['driver_first_name_err'] = 'First name must only contain letters';
        }

        if (empty($data['driver_last_name'])) {
          $data['driver_last_name_err'] = 'Please enter last name';
        } elseif (is_numeric($data['driver_last_name'])) {
          $data['driver_last_name_err'] = 'Last name cannot contant any number';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['driver_last_name'])) {
          $data['driver_last_name_err'] = 'Last name must only contain letters';
        }

        if (empty($data['driver_email'])) {
          $data['driver_email_err'] = 'Please enter email address';
        } elseif (!filter_var($data['driver_email'], FILTER_VALIDATE_EMAIL)) {
          $data['driver_email_err'] = 'Enter valid email.';
        } elseif ($this->userModel->findUserByEmail($data['driver_email'])) {
          $data['driver_email_err'] = 'Email is already taken';
        }

        if (empty($data['driver_contact'])) {
          $data['driver_contact_err'] = 'Please enter contact number';
        } elseif (strlen($data['driver_contact']) < 11) {
          $data['driver_contact_err'] = 'Contact must not be less than 11 characters.';
        } elseif (!is_numeric($data['contact'])) {
          $data['driver_contact_err'] = 'Invalid contact number';
        }

        if (empty($data['driver_address'])) {
          $data['driver_address_err'] = 'Please enter address';
        }

        if (empty($data['driver_city'])) {
          $data['driver_city_err'] = 'Please enter city';
        } elseif (is_numeric($data['driver_city'])) {
          $data['driver_city_err'] = 'Input for city must not have any numeric value';
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['driver_city'])) {
          $data['driver_city_err'] = 'City must only contain letters';
        }

        if (empty($data['driver_username'])) {
          $data['driver_username_err'] = 'Please enter username';
        } elseif ($this->userModel->findDriverByUsername($data['driver_username'])) {
          $data['driver_username_err'] = 'Username is already taken';
        }

        if (empty($data['driver_password'])) {
          $data['driver_password_err'] = 'Please enter password';
        } elseif (strlen($data['driver_password']) < 6) {
          $data['driver_password_err'] = 'Password must be at least 6 characters';
        }

        if (empty($data['driver_confirm_password'])) {
          $data['driver_confirm_password_err'] = 'Please enter confirm password';
        } elseif ($data['driver_password'] != $data['driver_confirm_password']) {
          $data['driver_confirm_password_err'] = 'Passwords do not match';
        }

        if (empty($data['driver_first_name_err']) && empty($data['driver_last_name_err']) && empty($data['driver_email_err']) && empty($data['driver_contact_err']) && empty($data['driver_address_err']) && empty($data['driver_city_err']) && empty($data['driver_username_err']) && empty($data['driver_password_err']) && empty($data['driver_confirm_password_err'])) {

          $data['driver_password'] = password_hash($data['driver_password'], PASSWORD_DEFAULT);
          if ($this->driverModel->add($data)) {
            flash('driver_message', 'Registered Successfully');
            redirect('drivers/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('drivers/add', $data);
        }
      } else {
        $data = [
          'driver_first_name' => '',
          'driver_last_name' => '',
          'driver_email' => '',
          'driver_contact' => '',
          'driver_address' => '',
          'driver_city' => '',
          'driver_username' => '',
          'driver_password' => '',
          'driver_confirm_password' => '',
          'driver_first_name_err' => '',
          'driver_last_name_err' => '',
          'driver_email_err' => '',
          'driver_contact_err' => '',
          'driver_address_err' => '',
          'driver_city_err' => '',
          'driver_username_err' => '',
          'driver_password_err' => '',
          'driver_confirm_password_err' => ''
        ];

        $this->view('drivers/add', $data);
      }
    } else {
      redirect('pages');
    }
  }
}
