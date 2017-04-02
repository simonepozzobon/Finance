<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotInvoiceInvoiceItem extends Migration
{
    public function up()
    {
        Schema::create('invoice_invoice_items', function (Blueprint $table) {
            $table->primary(['invoice_id', 'invoice_item_id']);
            $table->integer('invoice_id')->index();
            $table->integer('invoice_item_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_invoice_items');
    }
}
