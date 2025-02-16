<?php

  Namespace App\Enum;

  enum AccountStatus: string {

    case Active = 'Active';
    case Banned = 'Banned';
    case Inactive = 'Inactive';
  }

?>