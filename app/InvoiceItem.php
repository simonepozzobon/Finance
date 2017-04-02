<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
  protected $table = 'invoice_items';

  public function invoices()
  {
    return $this->hasMany('App\InvoiceItem');
  }
}
