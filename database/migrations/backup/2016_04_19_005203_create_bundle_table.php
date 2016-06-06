<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBundleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bundle', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 100)->nullable();
			$table->string('subtitle', 50)->nullable();
			$table->string('about', 500)->nullable();
			$table->float('price', 10, 0)->default(0);
			$table->string('picture_url', 500)->nullable();
			$table->integer('visibility')->default(0);
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
		Schema::drop('bundle');
	}

}
