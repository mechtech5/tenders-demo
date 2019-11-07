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
        // Master Tables
        Schema::create('exp_vendor_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->string('name', 100);
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
            // $table->boolean('enabled')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inc_client_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->string('name', 100);
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
            // $table->boolean('enabled')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payment_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->unsignedInteger('account_id');
            $table->datetime('paid_at');
            $table->decimal('amount', 15, 4)->default(0.00);
            $table->unsignedInteger('vendor_id')->nullable();
            $table->string('narration', 100);
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
            $table->softDeletes();
        });

        Schema::create('account_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->string('name');
            $table->decimal('opening_balance', 15, 4)->default(0.00);
            $table->string('bank_name');
            $table->string('bank_phn');
            $table->text('bank_addr');
            // $table->boolean('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('expense_catg_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->string('name', 100);
            $table->text('description')->nullable();
            // $table->string('color')->nullable();
            // $table->boolean('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('expense_mode_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->string('name', 100);
            $table->text('description')->nullable();
            // $table->string('color')->nullable();
            // $table->boolean('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('work_site_mast', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('comp_id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            // $table->boolean('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // Detail Tables
        # Bills
        Schema::create('exp_bills', function(Blueprint $table){
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->string('bill_number', 100);
            $table->string('order_number', 100)->nullable();
            $table->string('bill_status_code', 100);
            $table->dateTime('billed_at');
            $table->dateTime('due_at');
            $table->decimal('amount', 15, 4)->default(0.00);
            //$table->string('currency_code',200);
            //$table->decimal('currency_rate',15, 8)->default('0.00');
            $table->unsignedInteger('vendor_id');         
            $table->string('vendor_name', 100);
            $table->string('vendor_email');
            $table->string('vendor_tax_number')->nullable();           
            $table->string('vendor_phone')->nullable();
            $table->text('vendor_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_histories', function($table){
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->unsignedInteger('bill_id');
            $table->string('status_code', 100);
            $table->boolean('notify', 1);
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_items', function($table){
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('item_id')->nullable();
            $table->string('name', 100);
            $table->string('sku', 100)->nullable();
            $table->decimal('quantity', 7, 2);
            $table->decimal('price', 15, 4);
            $table->decimal('total', 15, 4);
            $table->decimal('tax', 15, 4)->default(0.0000);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_item_taxes', function($table){
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('bill_item_id');
            $table->unsignedInteger('tax_id');
            $table->string('name', 100);
            $table->decimal('amount', 15, 4)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_payments', function($table){
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('account_id');
            $table->datetime('paid_at');
            $table->decimal('amount', 15, 4)->default(0.00);
            //$table->string('currency_code',200);
            //$table->decimal('currency_rate',15, 8)->default('0.00');
            $table->text('description');
            $table->string('payment_method', 100);
            $table->text('note')->nullable();
            $table->boolean('reconciled')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_statuses', function($table){
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);          
            $table->unsignedInteger('comp_id');
            $table->string('name', 100);
            $table->string('code', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exp_bill_totals', function($table){
            $table->increments('id');
            $table->string('account_code', 5)->default(10001);
            $table->unsignedInteger('comp_id');
            $table->unsignedInteger('bill_id');            
            $table->string('code', 100)->nullable();
            $table->string('name', 100);
            $table->decimal('amount', 15, 4)->default(0.00);
            $table->unsignedInteger('sort_order');
            $table->timestamps();
            $table->softDeletes();
        });

        # Invoices
        Schema::create('inc_invoices', function($table){
       		$table->increments('id');
            $table->string('account_code', 5)->default(10001);
       		$table->unsignedInteger('comp_id');
       		$table->string('invoice_number', 100);
       		$table->string('order_number', 100);
       		$table->string('invoice_status_code', 100);
       		$table->dateTime('invoiced_at');
       		$table->dateTime('due_at');
       		$table->decimal('amount', 15, 4);
       		$table->string('customer_name', 100);
       		$table->string('customer_email', 100);
       		$table->string('customer_tax_number', 100);
       		$table->string('customer_phone', 100);
       		$table->text('customer_address');
       		$table->text('notes');
       		$table->integer('category_id')->default(1);
       		$table->bigInteger('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inc_invoice_histories', function($table){
       		$table->increments('id');
            $table->string('account_code', 5)->default(10001);
       		$table->unsignedInteger('comp_id');
       		$table->bigInteger('invoice_id');
       		$table->string('status_code', 100);
       		$table->tinyInteger('notify');
       		$table->text('description');
       		$table->timestamps();
       		$table->softDeletes();
        });

        Schema::create('inc_invoice_items', function($table){
       		$table->increments('id');
            $table->string('account_code', 5)->default(10001);
       		$table->unsignedInteger('comp_id');
       		$table->bigInteger('invoice_id');
       		$table->bigInteger('item_id');
       		$table->string('name', 100);
       		$table->string('sku', 100);
       		$table->decimal('quantity', 7, 2);
       		$table->decimal('price', 15, 4);
       		$table->decimal('total', 15, 4);
       		$table->decimal('tax', 15, 4);
       		$table->timestamps();
       		$table->softDeletes();
        });

        Schema::create('inc_invoice_item_taxes', function($table){
	       	$table->increments('id');
            $table->string('account_code', 5)->default(10001);
	       	$table->unsignedInteger('comp_id');
	       	$table->bigInteger('invoice_id');
	       	$table->bigInteger('invoice_item_id');
	       	$table->bigInteger('tax_id');
	       	$table->string('name', 100);
	       	$table->decimal('amount', 15, 4);
			$table->timestamps();
       		$table->softDeletes();
        });

        Schema::create('inc_invoice_payments', function($table){
	       	$table->increments('id');
            $table->string('account_code', 5)->default(10001);
	       	$table->unsignedInteger('comp_id');
	       	$table->bigInteger('invoice_id');
	       	$table->bigInteger('account_id');
	       	$table->dateTime('paid_at');	
	       	$table->decimal('amount', 15, 4);
	       	$table->text('description')->nullable();
	       	$table->string('payment_method', 100);
	       	$table->string('reference', 100);
	       	$table->tinyInteger('reconciled');
			$table->timestamps();
       		$table->softDeletes();
        });

        Schema::create('inc_invoice_statuses', function($table){
        	$table->increments('id');
            $table->string('account_code', 5)->default(10001);
        	$table->unsignedInteger('comp_id');
        	$table->string('name', 100);
        	$table->string('code', 100);
        	$table->timestamps();
       		$table->softDeletes();
        });

        Schema::create('inc_invoice_totals', function($table){
        	$table->increments('id');
            $table->string('account_code', 5)->default(10001);
        	$table->unsignedInteger('comp_id');
        	$table->bigInteger('invoice_id');
        	$table->string('name', 100);
    		$table->string('code', 100);
    		$table->decimal('amount', 15, 4);
    		$table->integer('sort_order');
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
        Schema::dropIfExists('exp_vendor_mast');
        Schema::dropIfExists('inc_client_mast');
        Schema::dropIfExists('payment_mast');
        Schema::dropIfExists('account_mast');
        Schema::dropIfExists('expense_catg_mast');

        // Detail Tables
        

        Schema::dropIfExists('exp_catg_mast');
        Schema::dropIfExists('exp_mode_mast');
        Schema::dropIfExists('exp_permit_user');
        Schema::dropIfExists('exp_in_user');
        Schema::dropIfExists('exp_site_mast');


        Schema::dropIfExists('exp_bills');
        Schema::dropIfExists('exp_bill_histories');
        Schema::dropIfExists('exp_bill_items');
        Schema::dropIfExists('exp_bill_item_taxes');
        Schema::dropIfExists('exp_bill_payments');
        Schema::dropIfExists('exp_bill_statuses');
        Schema::dropIfExists('exp_bill_totals');

        // Invoices 
        Schema::dropIfExists('inc_invoices');
        Schema::dropIfExists('inc_invoice_histories');
        Schema::dropIfExists('inc_invoice_items');
        Schema::dropIfExists('inc_invoice_item_taxes');
        Schema::dropIfExists('inc_invoice_payments');
        Schema::dropIfExists('inc_invoice_statuses');
        Schema::dropIfExists('inc_invoice_totals');

    }
}