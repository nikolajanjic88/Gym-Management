<?php

require_once base_path('core/config.php');

if(isset($_GET['export']))
{
  switch($_GET['export'])
  {
    case 'members':
      $sql = "SELECT id, first_name, last_name, email FROM members";
      $csv_cols = [
          'id', 'first_name', 'last_name', 'email'
      ];
      break;
    case 'trainers':
      $sql = "SELECT id, first_name, last_name, email FROM trainers";
      $csv_cols = [
        'id', 'first_name', 'last_name', 'email'
      ];
      break;
    default: 'Error';
  }
   
  $stmt = $conn->query($sql);
  $results = $stmt->fetch_all(MYSQLI_ASSOC);

  $output = fopen('php://output', 'w');
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename=' . $_GET['export'] . '.csv');

  fputcsv($output, $csv_cols);
  
  foreach($results as $result)
  {
    fputcsv($output, $result);
  }

  fclose($output);
}