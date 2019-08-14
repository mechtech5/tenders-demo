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
            $table->string('grp_code', 1)->primary();
            $table->string('grp_name', 100);
            $table->string('grp_desc', 250)->nullable();
        });

        Schema::create('comp_mast', function (Blueprint $table) {
            $table->string('comp_code', 3)->primary();
            $table->string('grp_code', 1);
            $table->string('comp_name', 100);
            $table->string('comp_desc', 250)->nullable();
            $table->boolean('enabled')->default(1);
        });

        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedInteger('user_id');
            $table->string('name', 200);
            $table->string('email');
            $table->string('tax_number')->nullable();
            // Account Details
            $table->string('acc_no')->nullable();
            $table->string('acc_name')->nullable();
            $table->string('acc_ifsc')->nullable();
            // ---------------
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->boolean('enabled')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedInteger('account_id');
            $table->datetime('paid_at');
            $table->decimal('amount', 15, 4);
            $table->unsignedInteger('vendor_id')->nullable();
            $table->string('narration', 200);
            $table->unsignedInteger('catg_id');
            $table->unsignedInteger('mode_id');
            $table->unsignedInteger('exp_permit_user')->nullable();
            $table->unsignedInteger('exp_in_user')->nullable();
            $table->string('website')->nullable();

            /* payment status
                A - Approved
                H - Hold
                P - Pending
                D - Declined 
                F - Failed
                C - Cancelled
            */
            $table->char('status', 1)->default('A');
            
            $table->text('note')->nullable();
            $table->boolean('req_approval')->default(0);
            $table->boolean('reconciled')->default(0);
            $table->timestamps();
        });

        Schema::create('expense_catg_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grp_code', 1);
            $table->string('name', 100);
            $table->string('color')->nullable();
            $table->boolean('enabled')->default(1);
        });

        Schema::create('expense_mode_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grp_code', 1);
            $table->string('name', 100);
            $table->string('color')->nullable();
            $table->boolean('enabled')->default(1);
        });

        Schema::create('account_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comp_code', 3);
            $table->string('name');
            $table->decimal('opening_balance', 15, 4);
            $table->string('bank_name');
            $table->string('bank_phone');
            $table->text('bank_address');
            $table->boolean('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_permit_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('grp_code', 1);
            $table->string('comp_code', 3);
        });

        Schema::create('exp_in_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('grp_code', 1);
            $table->string('comp_code', 3);
        });

        Schema::create('exp_site_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('comp_code', 3);
            $table->string('site_name');
            $table->string('site_desc', 250);
            $table->text('note')->nullable();
            $table->boolean('enabled')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comp_grp');
        Schema::dropIfExists('comp_mast');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('expense_catg_mast');
        Schema::dropIfExists('account_mast');
        Schema::dropIfExists('exp_permit_user');
        Schema::dropIfExists('exp_in_user');
        Schema::dropIfExists('exp_site_mast');
    }
}
