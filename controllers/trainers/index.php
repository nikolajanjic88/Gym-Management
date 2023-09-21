<?php

require_once base_path('core/config.php');

$sql = "SELECT * FROM trainers";
$res = $conn->query($sql);
$trainers = $res->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $id = $_POST['id'];

  $sql = "DELETE FROM trainers WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  
  $_SESSION['success_message'] = 'Trainer deleted';
  header('Location: /trainers');
  die();
}

view('trainers/index.view.php', [
  'heading' => 'Trainers',
  'trainers' => $trainers
]);