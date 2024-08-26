<?php

use App\Models\Office;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('employeeNumber')->primary();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('extension');
            $table->string('email');
            $table->string('officeCode');
            $table->integer('reportsTo')->nullable();
            $table->string('jobTitle');
            $table->timestamps();
            
            $table->index('reportsTo');
            $table->foreign('officeCode')->references('officeCode')->on('offices')->onDelete('cascade');
            // $table->foreign('reportsTo')->references('employeeNumber')->on('employees')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['officeCode']);
            // $table->dropForeign(['reportsTo']);
        });
        
        Schema::dropIfExists('employees');
    }
};
