<?php

class Validator
{
  public static function string($value)
  {
    $value = trim($value);
    return $value === '';
  }

  public static function email($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  public static function select($value)
  {
    return $value === '0';
  }
}