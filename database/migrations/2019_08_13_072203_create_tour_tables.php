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
            $table->bigIncrements('emp_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('emp_code')->nullable();
            $table->string('comp_code', 3)->nullable();
            $table->string('grade_code', 2)->nullable();
            $table->unsignedInteger('login_user');
            $table->string('emp_name', 50);
            $table->enum('emp_gender', ['M', 'F', 'O'])->nullable();
            $table->date('emp_dob')->nullable();
            $table->unsignedInteger('emp_desg')->nullable();
            $table->date('join_dt')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('desg_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('emp_grade_mast', function (Blueprint $table) {
            $table->string('grade_code', 2)->primary();
            $table->string('comp_grp', 1);
            $table->decimal('entitled_amt', 15, 4)->default(0.00);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedBigInteger('emp_id');
            $table->string('purpose');
             $table->decimal('adv_amt', 15, 4)->default(0.00);
            $table->string('start_loc');
            $table->string('end_loc');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::create('tour_stages', function (Blueprint $table) {
            $table->bigIncrements('id');
           	$table->unsignedBigInteger('tour_id');
           	$table->unsignedBigInteger('creator_id');
            $table->text('note')->nullable();
            $table->Integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

         Schema::create('tour_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',255);
            $table->timestamps();
            $table->softDeletes();   
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_mast');
        Schema::dropIfExists('desg_mast');
        Schema::dropIfExists('tours');
        Schema::dropIfExists('tour_stages');
    }
}
