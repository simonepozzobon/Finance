<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  protected $table = 'invoices';

  public function invoiceItems()
  {
    return $this->belongsToMany('App\InvoiceItem');
  }
}
