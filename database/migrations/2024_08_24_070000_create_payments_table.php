<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->integer('customerNumber');
            $table->string('checkNumber');
            $table->date('paymentDate');
            $table->decimal('amount', 10, 2 );
            $table->timestamps();

            $table->primary(['customerNumber', 'checkNumber']); //this is composite PK
            $table->foreign('customerNumber')->references('customerNumber')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
