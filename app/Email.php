<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function niceFolders($folders, $case_sensitive)
    {

      $array = [
        0 => 'Uk.London',
        1 => 'Uk.Manchester',
        2 => 'Uk.Liverpool',
        3 => 'Uk.Cardiff',
      ];

      $options = [
        '[Gmail]/',
        'INBOX.'
      ];

      foreach ($folders as $key => $folder) {
        $folders[$key] = str_replace($options, "", $folder);
      }

      return $folders;
    }

}
