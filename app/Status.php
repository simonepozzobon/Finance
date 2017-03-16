<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    public function projects()
    {
      return $this->hasMany('App\Project');
    }

    public function todos()
    {
      return $this->hasMany('App\Todo');
    }
}
