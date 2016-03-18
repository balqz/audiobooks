<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('email', 45)->unique('email_UNIQUE');
			$table->string('password', 500)->nullable();
			$table->string('name', 45)->nullable();
			$table->dateTime('birth_date_at')->nullable();
			$table->string('phone_number', 20)->nullable();
			$table->string('gender', 10)->nullable();
			$table->string('relationship_status', 45)->nullable();
			$table->string('location', 100)->nullable();
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
		Schema::drop('user');
	}

}
