<?php

require_once base_path('core/config.php');
require_once base_path('core/Validator.php');
require_once base_path('fpdf/fpdf.php');

//select all from training_plans 
$sql = "SELECT * FROM training_plans";
$stmt = $conn->query($sql);
$training_plans = $stmt->fetch_all(MYSQLI_ASSOC);

//select all from trainers
$sql = "SELECT * FROM trainers";
$stmt = $conn->query($sql);
$trainers = $stmt->fetch_all(MYSQLI_ASSOC);

//form submit
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $first_name = htmlspecialchars($_POST['first_name']);
  $last_name = htmlspecialchars($_POST['last_name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $training_plan_id = $_POST['training_plan_id'];
  $trainer_id = $_POST['trainer_id'];
  $photo_path = $_POST['photo_path'];
  $access_card_pdf = '';

  $errors = [];

  //validation
  if(Validator::string($first_name)) $errors['first_name'] = 'First name required';
  if(Validator::string($last_name)) $errors['last_name'] = 'Last name required';
  if(!Validator::email($email)) $errors['email'] = 'Not valid email';
  if(Validator::string($email)) $errors['email'] = 'Email required';
  if(Validator::select($training_plan_id)) $errors['training_plan_id'] = 'Select training program';
  if(Validator::select($trainer_id)) $errors['trainer_id'] = 'Select trainer';
  
  //phone and image are not required, set default values
  if($photo_path === '') $photo_path = NULL;
  if(trim($phone) === '') $phone = 'No phone number';

  //check if user exists
  $sql = "SELECT * FROM members WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->fetch();
  if($result) $errors['email'] = 'User already exists';

  //insert into database if there's no errors
  if(empty($errors))
  {
    $sql = "INSERT INTO members
    (first_name,	last_name,	email,	phone,	image,	training_plan_id,	trainer_id,	access_card)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiis", $first_name, $last_name, $email, $phone, $photo_path, $training_plan_id, $trainer_id, $access_card_pdf);
    $stmt->execute();

    $member_id = $conn->insert_id;

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(40, 10, 'Access Card');
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Member ID: ' . $member_id);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Name: ' . $first_name . ' ' . $last_name);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Email: ' . $email);
    $pdf->Ln();

    $filename = 'access_cards/access_card_' . $member_id . '.pdf';
    $pdf->Output('F', $filename);

    $sql = "UPDATE members SET access_card = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $filename, $member_id);
    $stmt->execute();

    $conn->close();

    $_SESSION['success_message'] = 'Member added successfully';
    header('location: /');
  }
    
}

view('members/create.view.php', [
  'heading' => 'Register Member',
  'errors' => $errors ?? null,
  'training_plans' => $training_plans,
  'trainers' => $trainers
]);