<?php
class Orders extends Controller
{
  public function __construct()
  {
    $this->orderModel = $this->model('Order');
    $this->driverModel = $this->model('Driver');
    $this->paymentModel = $this->model('Payment');
  }

  public function index()
  {
    if (Auth::adminAuth()) {
      $orders = $this->orderModel->getAllPendingOrders();

      $data = [
        'orders' => $orders
      ];

      $this->view('orders/index', $data);
    } else {
      redirect('pages');
    }
  }

  public function assignDriver($id)
  {
    if (Auth::adminAuth()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data = [
          'id' => $id,
          'driver_id' => $_POST['driver_id']
        ];

        $orders = $this->orderModel->assignDriver($data);
        $drivers = $this->driverModel->changeDriverStatusOnDelivery($data['driver_id']);

        if ($orders && $drivers) {
          flash('order_message', 'Delivery Driver Assigned');
          redirect('orders');
        } else {
          die('Something went wrong');
        }
      } else {
        $delivery_drivers = $this->driverModel->getAllAvailableDrivers();

        $data = [
          'id' => $id,
          'delivery_drivers' => $delivery_drivers
        ];

        $this->view('orders/assign_delivery_driver', $data);
      }
    } else {
      redirect('pages');
    }
  }

  public function details($id)
  {
    $order_details = $this->orderModel->getAllOrderDetails($id);

    foreach ($order_details as $order_detail) {
      $user_first_name = $order_detail->user_first_name;
      $user_last_name = $order_detail->user_last_name;
      $user_email = $order_detail->user_email;
      $user_contact = $order_detail->user_contact;
      $user_address = $order_detail->user_address;
      $user_city = $order_detail->user_city;
      $shipping_first_name = $order_detail->shipping_first_name;
      $shipping_last_name = $order_detail->shipping_last_name;
      $shipping_email = $order_detail->shipping_email;
      $shipping_contact = $order_detail->shipping_contact;
      $shipping_address = $order_detail->shipping_address;
      $shipping_city = $order_detail->shipping_city;
    }

    $data = [
      'user_first_name' => $user_first_name,
      'user_last_name' => $user_last_name,
      'user_email' => $user_email,
      'user_contact' => $user_contact,
      'user_address' => $user_address,
      'user_city' => $user_city,
      'shipping_first_name' => $shipping_first_name,
      'shipping_last_name' => $shipping_last_name,
      'shipping_email' => $shipping_email,
      'shipping_contact' => $shipping_contact,
      'shipping_address' => $shipping_address,
      'shipping_city' => $shipping_city,
      'order_details' => $order_details,
    ];

    $this->view('orders/details', $data);
  }

  public function completeOrder($order_id, $payment_id, $driver_id)
  {
    $orders = $this->orderModel->orderComplete($order_id);
    $payments = $this->paymentModel->paymentComplete($payment_id);
    $drivers = $this->driverModel->changeDriverStatusAvailable($driver_id);

    if ($orders && $payments && $drivers) {
      redirect('orders');
    }
  }

  public function completed()
  {
    $orders = $this->orderModel->getAllCompletedOrders();

    $data = [
      'orders' => $orders
    ];

    $this->view('orders/completed', $data);
  }
}
