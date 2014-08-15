<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
	    {
	        $table->increments('id');
	        $table->string('email')->unique();
	        $table->string('password');
	        $table->string('last_name');
	        $table->string('first_name');
	        $table->string('middle_name');
	        $table->string('globe_id');
	        $table->string('bank_account');
	        $table->string('mobile');
	        $table->string('gcash');
	        $table->string('group');
	        $table->string('division');
	        $table->string('department');
	        $table->timestamps();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
