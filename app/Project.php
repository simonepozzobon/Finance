<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";

    public function status()
    {
      return $this->belongsTo('App\Status');
    }

    public function client()
    {
      return $this->belongsTo('App\Client');
    }
}
