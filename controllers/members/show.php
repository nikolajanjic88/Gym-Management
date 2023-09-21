<?php

require_once base_path('core/config.php');
require_once base_path('core/Validator.php');

$sql = "SELECT * FROM members WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

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
  $training_plan_id = $_POST['training_plan_id'];
  $trainer_id = $_POST['trainer_id'];

  $errors = [];

  //validation
  if(Validator::select($training_plan_id)) $errors['training_plan_id'] = 'Select training program';
  if(Validator::select($trainer_id)) $errors['trainer_id'] = 'Select trainer';

  //insert into database if there's no errors
  if(empty($errors))
  {
    $sql = "UPDATE members SET training_plan_id = ?,	trainer_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $training_plan_id, $trainer_id);
    $stmt->execute();

    $conn->close();

    $_SESSION['success_message'] = 'Member updated successfully';
    header('location: /');
  }
    
}

view('members/show.view.php', [
  'heading' => 'Change Trainer and Training Plan for ' . $member['first_name'] . ' ' . $member['last_name'],
  'errors' => $errors ?? null,
  'training_plans' => $training_plans,
  'trainers' => $trainers,
  'member' => $member
]);