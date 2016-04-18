<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 50);
			$table->string('subtitle', 50)->nullable();
			$table->string('picture_url', 500)->nullable();
			$table->string('about', 500)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('parent_id')->nullable()->index('id_parent_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category');
	}

}
