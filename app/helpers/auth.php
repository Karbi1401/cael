<?php

class Auth
{
  public static function adminAuth()
  {
    if (isset($_SESSION['user_role']) && trim($_SESSION['user_role']) == 'admin') {
      return true;
    } else {
      return false;
    }
  }

  public static function userAuth()
  {
    if (isset($_SESSION['user_role']) && trim($_SESSION['user_role']) == 'user') {
      return true;
    } else {
      return false;
    }
  }

  public static function adminGuest()
  {
    if (!isset($_SESSION['admin_id'])) {
      return true;
    } else {
      return false;
    }
  }

  public static function userGuest()
  {
    if (!isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }
}
