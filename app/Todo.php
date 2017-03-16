<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $casts = [
      'completed' => 'boolean',
    ];

    public function status()
    {
      return $this->belongsTo('App\Status');
    }
}
