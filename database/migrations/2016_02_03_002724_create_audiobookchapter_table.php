<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudiobookchapterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audiobookchapter', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 100)->nullable();
			$table->string('subtitle', 50)->nullable();
			$table->float('price', 10, 0)->default(0);
			$table->string('about', 500)->nullable();
			$table->string('coverPictureUrl', 500)->nullable();
			$table->string('audioFileUrl', 500)->nullable();
			$table->dateTime('createdAt')->nullable();
			$table->dateTime('updatedAt');
			$table->integer('id_audiobook')->nullable()->index('id_audiobook_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audiobookchapter');
	}

}
