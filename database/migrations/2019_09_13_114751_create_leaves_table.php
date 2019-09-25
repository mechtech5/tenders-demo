<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->text('desc')->nullable();
            $table->integer('max_cont')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

         Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('appr_id');
            $table->integer('emp_id');
            $table->integer('leave_type');
            $table->date('start_dt');
            $table->date('end_dt');
            $table->decimal('duration',8,1);
            $table->text('reason');
            $table->integer('status')->nullable();  //fill latest status ID
            $table->timestamps();  
            $table->softDeletes();
        });

         Schema::create('leave_approval_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('leave_id');
            $table->integer('act_id');
            $table->integer('state_id');
            $table->text('permits');
            $table->date('date');
            $table->char('status',1)->nullable(); //A(accepted)/R(rejected)/H(hold)
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('leaves');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('leave_approval_detail');
    }
}
