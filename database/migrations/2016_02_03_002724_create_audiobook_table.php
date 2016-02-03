<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudiobookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audiobook', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 100);
			$table->string('subtitle', 50)->nullable();
			$table->string('author', 70)->nullable();
			$table->string('publisher', 70)->nullable();
			$table->string('isbn', 45)->nullable();
			$table->float('price', 10, 0)->default(0);
			$table->string('about', 500)->nullable();
			$table->string('audioFileUrl', 500)->nullable();
			$table->string('coverPictureUrl', 500)->nullable();
			$table->string('copyrightYear', 10)->nullable();
			$table->integer('visibility')->default(0);
			$table->dateTime('releasedAt')->nullable();
			$table->dateTime('createdAt');
			$table->dateTime('updatedAt');
			$table->integer('id_category')->nullable()->index('id_category_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audiobook');
	}

}
