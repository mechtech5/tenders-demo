<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_mast', function (Blueprint $table) {
            $table->bigIncrements('emp_id');
            $table->string('emp_code')->nullable();
            $table->string('comp_code', 3);
            $table->unsignedInteger('user_id');
            $table->string('emp_name', 50);
            $table->enum('emp_gender', ['M', 'F', 'O']);
            $table->date('emp_dob');
            $table->boolean('active')->default(1);
        });

        Schema::create('dsgn_mast', function (Blueprint $table) {
            $table->string('comp_code', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_tables');
    }
}
