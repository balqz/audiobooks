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
			$table->string('narrator', 70)->nullable();
			$table->string('isbn', 45)->nullable();
			$table->float('price', 10, 0)->default(0);
			$table->string('about', 500)->nullable();
			$table->string('audio_file_url', 500)->nullable();
			$table->string('audio_preview_file_url', 500)->nullable();
			$table->bigInteger('duration_seconds')->nullable();
			$table->string('cover_picture_url', 500)->nullable();
			$table->string('banner_picture_url', 500)->nullable();
			$table->string('copyright_year', 10)->nullable();
			$table->integer('visibility')->default(0);
			$table->dateTime('released_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('category_id')->nullable()->index('id_category_idx');
			$table->integer('publisher_id')->nullable()->index('audiobook.id_publisher_idx');
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
