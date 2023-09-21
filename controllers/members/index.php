<?php

require_once base_path('core/config.php');

$sql = "SELECT members.*, training_plans.name AS training_plan_name,
              trainers.first_name AS trainer_first_name,
              trainers.last_name AS trainer_last_name
              FROM members LEFT JOIN training_plans 
              ON members.training_plan_id = training_plans.id
              LEFT JOIN trainers
              ON members.trainer_id = trainers.id";
$res = $conn->query($sql);
$members = $res->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $id = $_POST['id'];

  $sql = "DELETE FROM members WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);
  $stmt->execute();

  $file = 'access_cards/access_card_' . $id . '.pdf';
  unlink($file);

  $conn->close();
  
  $_SESSION['success_message'] = 'Member deleted';
  header('Location: /');
  die();
}

view('members/index.view.php', [
  'heading' => 'Members',
  'members' => $members
]);