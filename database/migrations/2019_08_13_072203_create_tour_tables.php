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
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('emp_code')->nullable();
            $table->string('comp_code', 3);
            $table->string('grade_code', 2);
            $table->unsignedInteger('login_user');
            $table->string('emp_name', 50);
            $table->enum('emp_gender', ['M', 'F', 'O']);
            $table->date('emp_dob');
            $table->unsignedInteger('emp_desg');
            $table->boolean('active')->default(1);
        });

        Schema::create('dsgn_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->string('title', 100);
            $table->text('description')->nullable();
        });

        Schema::create('emp_grade_mast', function (Blueprint $table) {
            $table->string('grade_code', 2)->primary();
            $table->string('comp_grp', 1);
            $table->decimal('entitled_amt', 15, 4)->default(0.00);
            $table->text('description')->nullable();
        });

        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->string('purpose');
            $table->unsignedBigInteger('emp_id');
            $table->string('start_loc');
            $table->date('start_dt');
            $table->string('end_loc');
            $table->date('end_dt');
            $table->text('note')->nullable();
            $table->decimal('adv_amt', 15, 4)->default(0.00);

            /* tour status
                A - Approved
                H - Hold
                P - Pending
                D - Declined
                C - Cancelled
            */
            $table->char('adv_status', 1)->default('P');
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
        Schema::dropIfExists('dsgn_mast');
        Schema::dropIfExists('tours');
    }
}
