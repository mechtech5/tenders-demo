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
            $table->decimal('amount', 15, 4)->default(0.00);
            $table->unsignedInteger('vendor_id')->nullable();
            $table->string('narration', 200);
            $table->unsignedInteger('catg_id');
            $table->unsignedInteger('mode_id');
            $table->unsignedInteger('exp_permit_user')->nullable();
            $table->unsignedInteger('exp_in_user')->nullable();
            $table->string('email')->nullable();

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

        Schema::create('account_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comp_code', 3);
            $table->string('name');
            $table->decimal('opening_balance', 15, 4)->default(0.00);
            $table->string('bank_name');
            $table->string('bank_phn');
            $table->text('bank_addr');
            $table->boolean('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_catg_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grp_code', 1);
            $table->string('name', 100);
            $table->string('color')->nullable();
            $table->boolean('enabled')->default(1);
        });

        Schema::create('exp_mode_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grp_code', 1);
            $table->string('name', 100);
            $table->string('color')->nullable();
            $table->boolean('enabled')->default(1);
        });

        Schema::create('exp_permit_user', function (Blueprint $table) {
            $table->unsignedBigInteger('emp_id');
            $table->string('grp_code', 1);
            $table->string('comp_code', 3)->nullable();
        });

        Schema::create('exp_in_user', function (Blueprint $table) {
            $table->unsignedBigInteger('emp_id');
            $table->string('grp_code', 1);
            $table->string('comp_code', 3)->nullable();
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

        Schema::create('exp_bills', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->string('bill_number',200);
            $table->string('order_number',200)->nullable();
            $table->string('bill_status_code',200);
            $table->dateTime('billed_at');
            $table->dateTime('due_at');
            $table->decimal('amount', 15, 4)->default(0.00);
            //$table->string('currency_code',200);
            //$table->decimal('currency_rate',15, 8)->default('0.00');
            $table->unsignedInteger('vendor_id');         
            $table->string('vendor_name', 200);
            $table->string('vendor_email');
            $table->string('vendor_tax_number')->nullable();           
            $table->string('vendor_phone')->nullable();
            $table->text('vendor_address')->nullable();
            $table->text('notes')->nullable();
        });

        Schema::create('exp_bill_histories',function($table){
            $table->bigIncrements('id');
            $table->string('comp_code');
            $table->unsignedInteger('bill_id');
            $table->string('status_code', 200);
            $table->boolean('notify', 1);
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_items',function($table){
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('item_id')->nullable();
            $table->string('name', 200);
            $table->string('sku', 200)->nullable();
            $table->decimal('quantity', 7, 2);
            $table->decimal('price', 15, 4);
            $table->decimal('total', 15, 4);
            $table->decimal('tax', 15, 4)->default(0.0000);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_item_taxes',function($table){
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('bill_item_id');
            $table->unsignedInteger('tax_id');
            $table->string('name', 200);
            $table->decimal('amount', 15, 4)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_payments',function($table){
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('account_id');
            $table->datetime('paid_at');
            $table->decimal('amount', 15, 4)->default(0.00);
            //$table->string('currency_code',200);
            //$table->decimal('currency_rate',15, 8)->default('0.00');
            $table->text('description');
            $table->string('payment_method', 200);
            $table->text('note')->nullable();
            $table->boolean('reconciled')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_statuses',function($table){
            $table->bigIncrements('id');          
            $table->string('comp_code', 3);
            $table->string('name', 200);
            $table->string('code', 200);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_totals',function($table){
            $table->bigIncrements('id');
            $table->string('comp_code', 3);
            $table->unsignedInteger('bill_id');            
            $table->string('code', 200)->nullable();
            $table->string('name', 200);
            $table->decimal('amount', 15, 4)->default(0.00);
            $table->unsignedInteger('sort_order');
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
        Schema::dropIfExists('comp_grp');
        Schema::dropIfExists('comp_mast');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('account_mast');

        Schema::dropIfExists('exp_catg_mast');
        Schema::dropIfExists('exp_mode_mast');
        Schema::dropIfExists('exp_permit_user');
        Schema::dropIfExists('exp_in_user');
        Schema::dropIfExists('exp_site_mast');

        Schema::dropIfExists('exp_bills');
        Schema::dropIfExists('exp_bill_histories');
        Schema::dropIfExists('exp_bill_items');
        Schema::dropIfExists('exp_bill_payments');
        Schema::dropIfExists('exp_bill_statuses');
        Schema::dropIfExists('exp_bill_totals');

    }
}