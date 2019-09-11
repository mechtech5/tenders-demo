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
		  	 	$table->string('status_name',50);
		  	 	$table->string('status_desc',200);
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
    }
}
