<?php

require_once base_path('core/config.php');
require_once base_path('core/Validator.php');

if($_SERVER['REQUEST_METHOD'] === "POST")
{
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $errors = [];

  //validation
  if(Validator::string($first_name)) $errors['first_name'] = 'First name required';
  if(Validator::string($last_name)) $errors['last_name'] = 'Last name required';
  if(Validator::string($phone)) $errors['phone'] = 'Phone required';
  if(!Validator::email($email)) $errors['email'] = 'Not valid email';
  if(Validator::string($email)) $errors['email'] = 'Email required';

  //check if user exists
  $sql = "SELECT * FROM trainers WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->fetch();
  if($result) $errors['email'] = 'User already exists';

  if(empty($errors))
  {
    $sql = "INSERT INTO trainers (first_name, last_name, email, phone)
    VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $phone);
    $stmt->execute();

    $conn->close();

    $_SESSION['success_message'] = 'Trainer added successfully';
    header('location: /trainers');
  }
  
}

view('trainers/create.view.php', [
  'heading' => 'Add new trainer',
  'errors' => $errors ?? null
]);