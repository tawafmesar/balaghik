<?php


  ini_set('display_errors' , 'On');
  error_reporting(E_ALL);

  include 'include/connect.php';

  $sessionUser = '';
  if (isset($_SESSION['user'])) {
    $sessionUser = $_SESSION['user'];

  }

    // Rotes

 // include the Important file


  include 'include/header.php';
