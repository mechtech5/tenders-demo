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
      Schema::create('leave_type_mast', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name',100);
          $table->text('description')->nullable();
          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('leave_mast', function (Blueprint $table) {
          $table->bigIncrements('id');
      		$table->integer('leave_type');
      		$table->decimal('count',10,5);
      		$table->integer('generates_in');  // (days count)
					$table->decimal('max_apply_once',10,5);
					$table->decimal('min_apply_once',10,5);
					$table->decimal('max_days_month',10,5);
					$table->integer('max_apply_month');  // (how many times, user can apply)
					$table->integer('max_apply_year');
					$table->boolean('carry_forward');
          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('emp_leave_applies', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('emp_id');
          $table->integer('leave_type');
          $table->date('from');
          $table->date('to');
          $table->decimal('count',10,5);
          $table->text('reason');
          $table->string('file_path', 200)->nullable();
          $table->text('addr_during_leave');
          $table->string('contact_no',12);
          $table->char('status',1)->nullable();
          $table->text('applicant_remark')->nullable();
          $table->text('approver_remark')->nullable();
          $table->text('hr_remark')->nullable();
          $table->timestamps();
          $table->softDeletes();
      });

			Schema::create('emp_leave_allotment', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->date('start');
          $table->date('end');
      		$table->integer('emp_id');
      		$table->integer('leave_type');
      		$table->decimal('initial_bal',10,5);
      		$table->decimal('current_bal',10,5);
      		$table->integer('generates_in');  // (days count)
					$table->decimal('max_apply_once',10,5);
					$table->decimal('min_apply_once',10,5);
					$table->decimal('max_days_month',10,5);
					$table->integer('max_apply_month');  // (how many times, user can apply)
					$table->integer('max_apply_year');
          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('activity', function (Blueprint $table){
          $table->bigIncrements('id');
          $table->string('title');
          $table->string('desc');
      });

      Schema::create('leave_approval_mast', function (Blueprint $table){
          $table->bigIncrements('id');
          $table->integer('act_id');
          $table->string('title');
          $table->string('approve');
          $table->string('decline');
          $table->string('cancel');
          $table->string('hold');
          $table->string('skip');
          $table->string('desc');
      });

      Schema::create('approval_detail', function (Blueprint $table){
          $table->bigIncrements('id');
          $table->integer('leave_allotment_id');
          $table->integer('approval_id');
          $table->string('title');
          $table->string('approve');
          $table->string('decline');
          $table->string('cancel');
          $table->string('hold');
          $table->string('skip');
          $table->string('desc');
      });

      Schema::create('approval_actions_mast', function (Blueprint $table){
          $table->bigIncrements('id');
          $table->string('name');
          $table->text('description');
      });

      Schema::create('approval_setup_mast', function (Blueprint $table){
          $table->bigIncrements('id');
          $table->integer('emp_id');
          $table->integer('dept_id');
          $table->integer('designations_id');
          $table->integer('activity_id');
          $table->text('actions_id');
          $table->integer('ordering');
      });


    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('leave_type_mast');
      Schema::dropIfExists('leave_mast');
      Schema::dropIfExists('emp_leave_applies');
      Schema::dropIfExists('emp_leave_allotment');
      Schema::dropIfExists('activity');
      Schema::dropIfExists('leave_approval_mast');
      Schema::dropIfExists('approval_detail');
      Schema::dropIfExists('approval_actions_mast');
      Schema::dropIfExists('approval_setup_mast');

    }
}
