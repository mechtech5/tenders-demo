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
		   Schema::create('approval_detail', function (Blueprint $table) {
			    $table->bigIncrements('id');
			    $table->bigInteger('approval_id');
			    $table->string('title',255);
			    $table->string('approve',255);
			    $table->string('decline',255);
			    $table->string('cancel',255);
			    $table->string('hold',255);
			    $table->text('description')->nullable();
			    $table->timestamps();
			    $table->softDeletes();   
		  });
		   
		  Schema::create('activity', function (Blueprint $table) {
			    $table->bigIncrements('id');
			    $table->string('title',100);
			    $table->text('description')->nullable();
			    $table->timestamps();
			    $table->softDeletes();   
		  });

		   Schema::create('approval', function (Blueprint $table) {
			    $table->bigIncrements('id');
			    $table->bigInteger('activity_id');
			    $table->text('description')->nullable();
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
        Schema::dropIfExists('approval_detail');
        Schema::dropIfExists('activity');
        Schema::dropIfExists('approval');
    }
}
