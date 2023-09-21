<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'gym';

$conn = new mysqli($host, $username, $password, $db);

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  die();
}