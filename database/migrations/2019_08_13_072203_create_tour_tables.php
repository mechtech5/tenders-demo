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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('emp_code',191)->nullable();
            $table->integer('comp_id');
            $table->integer('dept_id')->nullable();
            $table->integer('desg_id');
            $table->integer('grade_id')->nullable();
            $table->string('emp_name', 50);
            $table->enum('emp_gender', ['M', 'F', 'O'])->nullable();
            $table->date('emp_dob')->nullable();
            $table->date('join_dt')->nullable();
            $table->integer('status_id')->nullable();
            $table->timestamps();
            $table->softDeletes();			
        });

        Schema::create('desg_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('comp_id');
            $table->string('desg_name', 50);
            $table->string('desg_desc',200)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('emp_grade_mast', function (Blueprint $table) {
            $table->string('grade_code', 2)->primary();
            $table->integer('comp_id');
            $table->decimal('entitled_amt', 15, 4)->default(0.00);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tour_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('current_stage');
            $table->string('purpose');
             $table->decimal('adv_amt', 15, 4)->default(0.00);
            $table->string('start_loc');
            $table->date('start_date');
            $table->string('end_loc');
            $table->date('end_date');
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
        Schema::dropIfExists('emp_grade_mast');     
    }
}
