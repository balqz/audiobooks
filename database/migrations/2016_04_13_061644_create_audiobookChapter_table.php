<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudiobookChapterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audiobookChapter', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 100)->nullable();
			$table->string('subtitle', 50)->nullable();
			$table->float('price', 10, 0)->default(0);
			$table->string('about', 500)->nullable();
			$table->string('cover_picture_url', 500)->nullable();
			$table->string('audio_file_url', 500)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('audiobook_id')->nullable()->index('id_audiobook_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audiobookChapter');
	}

}
