<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comp_grp', function (Blueprint $table) {
            $table->string('grp_code', 1);
            $table->string('grp_name', 100);
            $table->string('grp_desc', 250)->nullable();
        });

        Schema::create('comp_mast', function (Blueprint $table) {
            $table->string('comp_code', 3);
            $table->string('grp_code', 1);
            $table->string('comp_name', 100);
            $table->string('comp_desc', 250)->nullable();
            $table->boolean('enabled');
        });

        Schema::create('vendor_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedInteger('user_id');
            $table->string('name', 200);
            $table->string('email');
            $table->string('tax_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->boolean('enabled');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('comp_code', 3);
            $table->unsignedInteger('account_id');
            $table->datetime('paid_at');
            $table->decimal('amount', 15, 4);
            $table->unsignedInteger('vendor_id');
            $table->text('description')->nullable();
            $table->unsignedInteger('category_id');
            $table->string('website')->nullable();
            $table->boolean('enabled')->nullable();
            $table->text('note')->nullable();
            $table->boolean('reconciled');
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
        Schema::dropIfExists('expense_tables');
    }
}
