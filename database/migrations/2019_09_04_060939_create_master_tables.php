<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		   Schema::create('approval_template', function (Blueprint $table) {
			    $table->bigIncrements('id');
			    $table->bigInteger('appr_id');
			    $table->string('title',255);
			    $table->text('description')->nullable();
			    $table->string('permits',255);
			    $table->integer('is_mandatory')->default(0);
			    $table->timestamps();
			    $table->softDeletes();   
		  });
		   
		  Schema::create('approval_mast', function (Blueprint $table) {
			    $table->bigIncrements('id');
			    $table->string('title',100);
			    $table->text('description')->nullable();
			    $table->timestamps();
			    $table->softDeletes();   
		  });

		  Schema::create('emp_status_mast',function(Blueprint $table){
		  	 	$table->bigIncrements('id');
		  	 	$table->string('name',50);
		  	 	$table->text('desc')->nullable();
			    $table->timestamps();
			    $table->softDeletes();  
		  });

		  Schema::create('emp_grade_mast',function(Blueprint $table){
		  	 	$table->bigIncrements('id');
		  	 	$table->string('name',50);
		  	 	$table->unsignedInteger('comp_id');
		  	 	$table->decimal('entitled_amt',8,2);
		  	 	$table->text('desc')->nullable();
			    $table->timestamps();
			    $table->softDeletes();  
		  });



		  Schema::create('emp_type_mast',function(Blueprint $table){
		  	 	$table->bigIncrements('id');
		  	 	$table->string('name',50);
		  	 	$table->text('desc')->nullable();
			    $table->timestamps();
			    $table->softDeletes();  
		  });

		  Schema::create('event_mast',function(Blueprint $table){
		  	 	$table->bigIncrements('id');
		  	 	$table->string('name',50);
		  	 	$table->text('desc')->nullable();
			    $table->timestamps();
			    $table->softDeletes();  
		  });

		   Schema::create('domain_mast',function(Blueprint $table){
		  	 	$table->bigIncrements('id');
		  	 	$table->string('name',50);
		  	 	$table->text('desc')->nullable();
			    $table->timestamps();
			    $table->softDeletes();  
		  });

		   Schema::create('asset_mast',function(Blueprint $table){
		  	 	$table->bigIncrements('id');
		  	 	$table->string('name',50);
		  	 	$table->text('desc')->nullable();
			    $table->timestamps();
			    $table->softDeletes();  
		  });

		    Schema::create('doc_type_mast',function(Blueprint $table){
		  	 	$table->bigIncrements('id');
		  	 	$table->string('name',50);
		  	 	$table->text('desc')->nullable();
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
        Schema::dropIfExists('approval_template');
        Schema::dropIfExists('approval_mast');
        Schema::dropIfExists('emp_status_mast');
        Schema::dropIfExists('emp_grade_mast');
        Schema::dropIfExists('emp_type_mast');
        Schema::dropIfExists('event_mast');
        Schema::dropIfExists('domain_mast');
        Schema::dropIfExists('asset_mast');
        Schema::dropIfExists('doc_type_mast');
    }
}
