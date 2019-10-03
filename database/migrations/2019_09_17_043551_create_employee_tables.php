<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_mast', function (Blueprint $table) { //single row
          $table->increments('id');
          $table->unsignedInteger('parent_id')->nullable();
          $table->string('emp_code', 15)->nullable();
          $table->unsignedInteger('comp_id')->nullable();
          $table->unsignedInteger('dept_id')->nullable();
          $table->unsignedInteger('desg_id');
          $table->unsignedInteger('grade_id')->nullable();
          $table->string('emp_name', 50);
          $table->string('emp_img', 200)->default('emp_default_image.png');
          $table->enum('emp_gender', ['M', 'F', 'O'])->nullable();
          $table->date('emp_dob')->nullable();
          $table->text('curr_addr')->nullable();
          $table->text('perm_addr')->nullable();
          $table->string('blood_grp',3)->nullable();
          $table->string('contact', 50)->nullable();
          $table->string('alt_contact', 50)->nullable();
          $table->string('email', 50)->nullable();
          $table->string('alt_email', 50)->nullable();
          $table->string('driv_lic', 20)->nullable();
          $table->string('aadhar_no', 20)->nullable();
          $table->string('voter_id', 20)->nullable();
          $table->string('pan_no', 20)->nullable();
          $table->unsignedInteger('emp_type')->nullable();
          $table->unsignedInteger('emp_status')->nullable();
          $table->string('old_uan', 20)->nullable();
          $table->string('curr_uan', 20)->nullable();
          $table->string('old_pf', 20)->nullable();
          $table->string('curr_pf', 20)->nullable();
          $table->string('old_esi', 20)->nullable();
          $table->string('curr_esi', 20)->nullable();
          $table->date('join_dt')->nullable();
          $table->date('leave_dt')->nullable();
          $table->integer('active')->default(1);
          $table->timestamps();
          $table->softDeletes();			
        });

        Schema::create('emp_nominee', function (Blueprint $table) { //multiple rows
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->string('name', 100);
          $table->string('email', 100)->nullable();
          $table->text('address');
          $table->string('aadhar_no', 20);
          $table->string('contact', 20)->nullable();
          $table->text('addr')->nullable();
          $table->string('file_path',200)->nullable(); // aadhar
          $table->string('relation', 20)->nullable();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_events', function (Blueprint $table) { //mul rows
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->unsignedInteger('event');
          $table->date('date');
          $table->string('file_path',200)->nullable();
          $table->text('note')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_bank_details', function (Blueprint $table) { //mul rows
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->string('acc_no', 50);
          $table->string('bank_name', 50);
          $table->string('ifsc', 50);
          $table->string('branch_name', 50);
          $table->string('file_path',200)->nullable();
          $table->text('note')->nullbale();
          $table->boolean('is_primary')->default(0);
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_academics', function (Blueprint $table) { //mul rows
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->string('domain_of_study',90);
          $table->string('name_of_unversity', 90)->nullable();
          $table->string('completed_in_year', 4)->nullable();
          $table->string('grade_or_pct', 10)->nullable();
          $table->string('file_path',200)->nullable();
          $table->text('note')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_family', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->string('relation',50);
          $table->string('name',10);
          $table->string('occ',50);
          $table->string('contact',15);
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_assets', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->date('assign_date');
          $table->date('return_date')->nullable();
          $table->string('assign_note', 200);
          $table->string('return_note', 200)->nullable();
          $table->decimal('estimated_cost', 8, 2);
          $table->string('file_path',200)->nullable();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_exp', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->string('comp_name', 100);
          $table->string('job_type', 50)->nullable(); // Part-time, contract, full-time, etc
          $table->decimal('monthly_ctc', 8, 2)->nullable();
          $table->string('desg', 50)->nullable();
          $table->string('comp_loc', 50)->nullable();
          $table->string('comp_email', 100)->nullable();
          $table->string('comp_website', 100)->nullable();
         	$table->date('start_dt')->nullable();
          $table->date('end_dt')->nullable();
          $table->text('reason_of_leaving')->nullable();
          $table->string('file_path',200)->nullable();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_docs', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('emp_id');
          $table->unsignedInteger('doc_type_id');
          $table->text('file_path');
          $table->string('remarks');
          $table->char('doc_status', 1);  //S (submitted), P (provided)
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
      Schema::dropIfExists('emp_nominee');
      Schema::dropIfExists('emp_events');
      Schema::dropIfExists('emp_bank_details');
      Schema::dropIfExists('emp_academics');
      Schema::dropIfExists('emp_family');
      Schema::dropIfExists('emp_assets');
      Schema::dropIfExists('emp_exp');
      Schema::dropIfExists('emp_docs');
    }
}
