<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Master Tables
         Schema::create('tender_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->string('tender_no')->nullable();
            $table->string('title');     
            $table->string('place')->nullable();    
            $table->boolean('is_eligible')->default(1);
            $table->unsignedInteger('category_id'); // FK (Supply/Execution/Supply+Execution)
            $table->unsignedInteger('type_id'); // FK (New/Existing/Pending)
            $table->tinyInteger('priority');
            $table->timestamp('publish_date')->nullable();
            $table->timestamp('online_submission_date')->nullable();
            $table->timestamp('physical_submission_date')->nullable();
            $table->timestamp('technical_opening_date')->nullable();
            $table->timestamp('financial_opening_date')->nullable();
            $table->text('compulsory_matters')->nullable();
            $table->decimal('document_cost', 8, 2)->nullable();
            $table->decimal('total_cost', 8, 2)->nullable();
            $table->string('fill_company_name')->nullable();
            $table->string('fill_company_office')->nullable();
            $table->unsignedInteger('synopsis_creation_resp')->nullable();
            $table->unsignedInteger('filling_resp')->nullable();
            $table->unsignedInteger('ref_or_priority_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tender_type_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tender_catg_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tender_client_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        // Detail Tables
        Schema::create('tender_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('tender_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tender_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('tender_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tender_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('tender_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tender_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('tender_id');
            $table->timestamps();
            $table->softDeletes();      
        });

        Schema::create('tender_client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('email',15)->nullable();
            $table->string('desig',15)->nullable();
            $table->string('number',15)->nullable();
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
        // Master Tables
        Schema::dropIfExists('tender_mast');
        Schema::dropIfExists('tender_type_mast');
        Schema::dropIfExists('tender_catg_mast');
        Schema::dropIfExists('tender_client_mast');

        // Detail Tables
        Schema::dropIfExists('tender_docs');
        Schema::dropIfExists('tender_reviews');
        Schema::dropIfExists('tender_meetings');
        Schema::dropIfExists('tender_expenses');
    }
}
