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
      Schema::create('comp_mast', function (Blueprint $table) {
  		$table->increments('id');
  		$table->string('account_code', 5)->default(10001);
        $table->string('name', 100);
        $table->text('description')->nullable();
        $table->timestamps();
        $table->softDeletes();
      });
      Schema::create('dept_mast', function (Blueprint $table) {
    	$table->increments('id');
    	$table->string('account_code', 5)->default(10001);
	    $table->string('name', 100);
	    $table->string('description')->nullable();
	    $table->timestamps();
	    $table->softDeletes();
      });
  		Schema::create('desg_mast', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('account_code', 5)->default(10001);
	        $table->string('name', 100);
	        $table->text('description')->nullable();
	        $table->timestamps();
	        $table->softDeletes();
    	});
		  Schema::create('approval_mast', function (Blueprint $table) {
			    $table->increments('id');
			    $table->string('account_code', 5)->default(10001);
			    $table->string('name', 100);
			    $table->text('description')->nullable();
			    $table->timestamps();
			    $table->softDeletes();   
		  });
		  Schema::create('emp_grade_mast',function(Blueprint $table){
		  	 	$table->increments('id');
		  	 	$table->string('account_code', 5)->default(10001);
		  	 	$table->string('name', 100);
		  	 	$table->text('description')->nullable();
			    $table->timestamps();
			    $table->softDeletes();  
		  });
		  Schema::create('emp_status_mast',function(Blueprint $table){
	  	 	$table->increments('id');
	  	 	$table->string('account_code', 5)->default(10001);
	  	 	$table->string('name', 100);
	  	 	$table->text('description')->nullable();
		    $table->timestamps();
		    $table->softDeletes();  
		  });
		  Schema::create('emp_type_mast',function(Blueprint $table){
	  	 	$table->increments('id');
	  	 	$table->string('account_code', 5)->default(10001);
	  	 	$table->string('name', 100);
	  	 	$table->text('description')->nullable();
		    $table->timestamps();
		    $table->softDeletes();  
		  });
		  Schema::create('emp_event_mast',function(Blueprint $table){
	  	 	$table->increments('id');
	  	 	$table->string('account_code', 5)->default(10001);
	  	 	$table->string('name', 100);
	  	 	$table->text('description')->nullable();
		    $table->timestamps();
		    $table->softDeletes();  
		  });
	   	Schema::create('asset_mast',function(Blueprint $table){
	  	 	$table->increments('id');
	  	 	$table->string('account_code', 5)->default(10001);
	  	 	$table->string('name', 100);
	  	 	$table->text('description')->nullable();
		    $table->timestamps();
		    $table->softDeletes();  
		  });
	    Schema::create('doc_type_mast',function(Blueprint $table){
	  	 	$table->increments('id');
	  	 	$table->string('account_code', 5)->default(10001);
	  	 	$table->string('name', 100);
	  	 	$table->text('description')->nullable();
		    $table->timestamps();
		    $table->softDeletes();
		    });     
		  Schema::create('approval_template', function (Blueprint $table) {
			    $table->increments('id');
			    $table->string('account_code', 5)->default(10001);
			    $table->unsignedInteger('appr_id');
			    $table->string('title', 100);
			    $table->text('description')->nullable();
			    $table->string('permits', 255);
			    $table->integer('is_mandatory')->default(0);
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
        Schema::dropIfExists('emp_event_mast');
        Schema::dropIfExists('asset_mast');
        Schema::dropIfExists('doc_type_mast');
    }
}
