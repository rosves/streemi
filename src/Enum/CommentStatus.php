<?php

  Namespace App\Enum;

  enum CommentStatus: string {
    case Liked = 'Liked';
    case Watch = 'Watch';
    case UnWatch = 'UnWatch';
  }

?>