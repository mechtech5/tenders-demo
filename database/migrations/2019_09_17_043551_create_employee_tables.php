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
        Schema::create('emp_mast', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('parent_id')->nullable();
          $table->string('emp_code',15)->nullable();
          $table->unsignedInteger('comp_id')->nullable();
          $table->unsignedInteger('dept_id')->nullable();
          $table->unsignedInteger('desg_id');
          $table->unsignedInteger('grade_id')->nullable();
          $table->string('emp_name', 50);
          $table->enum('emp_gender', ['M', 'F', 'O'])->nullable();
          $table->date('emp_dob')->nullable();
          $table->text('curr_addr')->nullable();
          $table->text('perm_addr')->nullable();
          $table->string('blood_grp',3)->nullable();
          $table->string('contact',50)->nullable();
          $table->string('alt_contact',50)->nullable();
          $table->string('email',50)->nullable();
          $table->string('alt_email',50)->nullable();
          $table->string('driv_lic',20)->nullable();
          $table->string('aadhar_no',20)->nullable();
          $table->string('voter_id',20)->nullable();
          $table->string('pan_no',20)->nullable();
          $table->unsignedInteger('emp_type')->nullable();
          $table->unsignedInteger('emp_status')->nullable();
          $table->string('old_uan',20)->nullable();
          $table->string('curr_uan',20)->nullable();
          $table->string('old_pf',20)->nullable();
          $table->string('curr_pf',20)->nullable();
          $table->string('old_esi',20)->nullable();
          $table->string('curr_esi',20)->nullable();
          $table->date('join_dt')->nullable();
          $table->date('leave_dt')->nullable();
          $table->integer('active')->default(1);
          $table->timestamps();
          $table->softDeletes();			
        });

        Schema::create('emp_nominee', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->string('name', 50);
          $table->string('email', 50)->nullable();
          $table->string('aadhar_no', 20)->nullable();
          $table->string('contact',50)->nullable();
          $table->text('addr')->nullbale();
          $table->string('relation', 20)->nullable();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_events', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->unsignedInteger('event');
          $table->date('date');
          $table->text('note')->nullbale();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_bank_details', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->string('acc_no',50);
          $table->string('bank_name',50);
          $table->string('ifsc',50);
          $table->string('branch_name',50);
          $table->unsignedInteger('doc_id');
          $table->text('note')->nullbale();
          $table->boolean('is_primary')->default(0);
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_academics', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->string('domain_of_study',255);
          $table->string('name_of_unversity',100);
          $table->string('completed_in',10);
          $table->string('grade_per',50);
          $table->text('note')->nullbale();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_family', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->string('relation',50);
          $table->string('name',10);
          $table->string('occ',50);
          $table->string('contact',15);
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_assets', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->date('assig_date');
          $table->text('detail');
          $table->date('return_date')->nullable();
          $table->text('remark');
          $table->decimal('estimated_cost',8,2);
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_exp', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->string('comp_name',50);
          $table->decimal('monthly_ctc',8,2);
          $table->string('desg',50);
          $table->string('comp_loc',50);
          $table->string('comp_email',50);
          $table->text('comp_website');
         	$table->date('start_dt');
          $table->date('end_dt');
          $table->text('reason_of_leaving')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::create('emp_docs', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('emp_id');
          $table->unsignedInteger('doc_type_id');
          $table->unsignedInteger('doc_id');
          $table->text('remark')->nullable();
          $table->date('date');
          $table->char('doc_status',1);  //S (submitted), P (provided)
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
